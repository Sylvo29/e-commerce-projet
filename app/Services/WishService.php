<?php

namespace App\Services;

use App\Models\Product; // Make sure to import the Product model here
use Illuminate\Support\Facades\Session;

class WishService
{
    public function addProductToWish($productId)
    {
        $wishProducts = Session::get('wish', []);

        if (!in_array($productId, $wishProducts)) {
            $wishProducts[] = $productId;
            Session::put('wish', $wishProducts);
        }
    }

    public function removeProductFromWish($productId)
    {
        $wishProducts = Session::get('wish', []);

        $index = array_search($productId, $wishProducts);
        if ($index !== false) {
            unset($wishProducts[$index]);
            Session::put('wish', array_values($wishProducts));
        }
    }

    public function getWishedProducts()
    {
        return Session::get('wish', []);
    }

    public function getWishedProductsDetails()
    {
        $wishProducts = Session::get('wish', []);
        $wishedDetails = [];

        foreach ($wishProducts as $productId) {
            $product = Product::find($productId);

            if ($product) {
                $wishedDetails[] = [
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'name' => $product->name,
                    'description' => $product->description,
                    'soldePrice' => $product->soldePrice,
                    'regularPrice' => $product->sodePrice,
                    'imageUrls' => $product->imageUrls(),
                    'stock' => $product->stock,
                    // Ajoutez d'autres attributs du produit ici
                ];
            }
        }

        return $wishedDetails;
    }

    public function clearWishedProducts()
    {
        Session::forget('wish');
    }
}
