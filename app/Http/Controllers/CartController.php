<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\error;

class CartController extends Controller
{
    //
    public function index(CartService $cartService, Request $req): View|RedirectResponse
    {
        $cart = $cartService->getCartDetails();
        $carriers = Carrier::all();
        $carrierId = $req->input('carrier_id');
        $selectedCarrier = Carrier::first();

        if($carrierId && is_numeric($carrierId)){
            $carrierId = (int) $carrierId;
            $carrier = Carrier::find($carrierId);
            if($carrier){
                $selectedCarrier = $carrier;
            }
        }

        Session::get('carrier', $selectedCarrier);

        if(empty($cart['items'])){
            return redirect()->route('home')->with('danger', 'Sorry there is nothing from cart !');
        }

        foreach($cart['items'] as $items){
            $stock = $items['product']['stock'];  
            $quantity = $items['quantity']; 
         }
    
        // dd($stock);
        // dd($quantity);
        
        return view("jstore.cart", ["cart" => $cart,"stock" => $stock,"quantity" => $quantity, 'carriers'=>$carriers, 'selectedCarrier'=>$selectedCarrier]);
    }
    public function addToCart(CartService $cartService, $productId)
    {
        $cartService->addToCart($productId, 1);
        // $cart = $cartService->getCartDetails();
        
        return redirect()->route('cart');
    }
    public function removeFromCart(CartService $cartService, $productId, $quantity)
    {

        $cartService->removeFromCart($productId, $quantity);

        return redirect()->route('cart');
    }
}
