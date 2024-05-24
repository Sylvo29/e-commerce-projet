<?php

namespace App\Services;

use App\Models\Carrier;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use App\Models\Product; // Assurez-vous d'importer le modèle Product ici

class CartService
{
    public function addToCart($productId, $quantity)
    {
        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        Session::put('cart', $cart);
    }

    public function removeFromCart($productId, $quantity)
    {
        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            if ($cart[$productId] <= $quantity) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] -= $quantity;
            }

            Session::put('cart', $cart);
        }
    }

    public function clearCart()
    {
        Session::forget('cart');
    }

    public function getCartDetails()
    {
        $cart = Session::get('cart', []);
        $setting = Setting::first();
        $taxeRate = $setting ? $setting->taxeRate  / 100 : 0;

        $result = [
            'items' => [],
            'sub_total' => 0,
            'carrier_name' => 0,
            'shipping_price' => 0,
            'taxe_amount' => 0,
            'sub_total_ht' => 0,
            'sub_total_ttc' => 0,
            'sub_total_with_shipping' => 0,
            'cart_count' => 0,
        ];
        $carrier = Session::get('carrier', null);
        if(!$carrier){
            $carrier =  Carrier::first();
        }

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);

            if ($product) {
                $subTotal = $product->soldePrice * $quantity;
                $result['items'][] = [
                    'product' => [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'name' => $product->name,
                        'stock' => $product->stock,
                        'description' => $product->description,
                        'soldePrice' => $product->soldePrice,
                        'regularPrice' => $product->regularPrice,
                        'imageUrls' => $product->imageUrls(),
                        // Ajoutez d'autres attributs du produit ici
                    ],
                    'quantity' => $quantity,
                    'sub_total' => number_format($subTotal,2),
                    'taxe_amount' => number_format($subTotal /(1 + $taxeRate) * $taxeRate , 2),
                    'sub_total_ht' => number_format($subTotal /(1 + $taxeRate), 2),
                    'sub_total_ttc' => number_format($subTotal,2),
                ];
                $result['sub_total'] += number_format($subTotal,2);
                $result['cart_count'] += $quantity;
            }
        }

        // HT + to*HT = TTC
        // (1+to)*HT = TTC
        // HT = TTC/(1+to)

        $result['carrier_name'] = $carrier->name;
        $result['shipping_price'] = number_format($carrier->price, 2);

        $result['taxe_amount'] = number_format($result['sub_total'] /(1 + $taxeRate) * $taxeRate, 2);
        $result['sub_total_ht'] = number_format($result['sub_total'] /(1 + $taxeRate), 2);
        $result['sub_total_ttc'] = number_format($result['sub_total'], 2);
        $result['sub_total_with_shipping'] = number_format($result['sub_total'] + $carrier->price, 2);

        return $result;
    }

}
