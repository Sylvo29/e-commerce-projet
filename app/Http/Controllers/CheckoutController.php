<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Order;
use App\Models\Address;
use App\Models\Carrier;
use App\Models\Setting;
use Stripe\StripeClient;
use App\Models\Orderdetails;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\StripeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //
    private $stripeService;
    private $cartService;

    public function __construct(){
        $this->stripeService = new StripeService();
        $this->cartService = new CartService();
    }
    public function index(CartService $cartService, Request $request){
        $carrierId = $request->input('carrier_id');
        $billing_address_id = $request->input('billing_address_id');
        $shipping_address_id = $request->input('shipping_address_id');
        $different_address = $request->input('different_address', 'false');
        $orderId = null;

        if($carrierId && is_numeric($carrierId)){
            $carrierId = (int) $carrierId;
            $carrier = Carrier::find($carrierId);
            if($carrier){
                Session::put('carrier', $carrier);
            }
        }

        $cart = $cartService->getCartDetails();
        $readyToPay = false;

        if($different_address == 'true'){
            $readyToPay = $shipping_address_id && $billing_address_id;
        }else{
            $readyToPay = !!$billing_address_id;
        }

        if($readyToPay){
            $billing_address = "";
            $shipping_address = null;
            if($billing_address_id){
                $address = Address::find($billing_address_id);
                if($address){
                    $billing_address = $address->getAddress();
                }
            }
            if($different_address == 'true' && $shipping_address_id){
                $address = Address::find($shipping_address_id);
                if($address){
                    $shipping_address = $address->getAddress();
                }
            }
            $orderId = $this->createOrder($billing_address,$shipping_address);
        }

        $carriers = Carrier::all();
        $pages = Page::where('isCheckout', 'true')->get();

        $stripe_public_key = $this->stripeService->getPublicKey();

        return view("jstore.checkout", [
            "cart"=> $cart,
            "carriers"=> $carriers,
            "pages"=> $pages,
            "readyToPay"=> $readyToPay,
            "stripe_public_key"=> $stripe_public_key,
            'orderId' => $orderId
        ]);
    }

    public function createPaymentIntent(Request $request, $orderId){

        $stripe = new StripeClient($this->stripeService->getPrivateKey());

        $order = Order::find($orderId);

        $amount = intval($order->order_cost_ttc * 100, 0);


        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,// !!!!
            'currency' => 'eur',
            // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        $order->stripe_payment_intent = $paymentIntent->client_secret;

        $order->save();

        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }

    public function paymentSuccess(CartService $cartService, Request $request){
        $stripe_payment_intent = $request->payment_intent_client_secret;
        $redirect_status = $request->redirect_status;
        if($redirect_status === "succeeded"){
            $order = Order::where([
                'isPaid' => false,
                'stripe_payment_intent'=> $stripe_payment_intent
                ])->first();
              $this->updateStock();  
            if($order){
                $order->isPaid = true;
                $order->save();
            }
            $cartService->clearCart();
        }
        return view('jstore.ordercompleted');
    }

    protected function createOrder($billing_address, $shipping_address = null){
        $cart = $this->cartService->getCartDetails();

        $order = new Order();
        $user = Auth::user();
        $carrier = Session::get('carrier', Carrier::first());


        $order->clientName = $user->name;
        $order->billing_address = $billing_address;
        $order->shipping_address = $shipping_address ? $shipping_address : $billing_address;
        $order->carrier_name = $carrier->name;
        $order->carrier_price = $carrier->price;
        $order->quantity = $cart['cart_count'];
        $order->order_cost = $cart['sub_total_ht'];
        $order->taxe = $cart['taxe_amount'];
        $order->order_cost_ttc = $cart['sub_total_with_shipping'];
        $order->paymeny_method = 'Stripe';

        $order->save();

        foreach ($cart['items'] as  $item) {
            $orderDetails = new Orderdetails();
            $orderDetails->product_name = $item["product"]["name"];
            $orderDetails->product_description = $item["product"]["description"];
            $orderDetails->soldePrice = $item["product"]["soldePrice"];
            $orderDetails->regularPrice = $item["product"]["regularPrice"];
            $orderDetails->quantity = $item["quantity"];
            $orderDetails->taxe = $item["taxe_amount"];
            $orderDetails->sub_total_ht = $item["sub_total_ht"];
            $orderDetails->sub_total_ttc = $item['sub_total_ttc'];
            $orderDetails->order_id = $order->id;
            $orderDetails->save();
        }

        return $order->id;

    }

    private function updateStock()
    {
        $cart = $this->cartService->getCartDetails();

        foreach ($cart['items'] as  $value) {
            // dd($value);
            $product = Product::find($value['product']['id']);

            $product->update(['stock' =>$value["product"]["stock"] - $value['quantity']]);
        }
    }
}
