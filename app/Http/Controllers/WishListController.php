<?php

namespace App\Http\Controllers;

use App\Services\WishService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class WishListController extends Controller
{
    private WishService $wishService;
    public function __construct(WishService $wishService){
        $this->wishService = $wishService;
    }
    //
    public function index(Request $request): View|RedirectResponse{
        $wishlist = $this->wishService->getWishedProductsDetails();
        if(empty($wishlist)){
            return redirect()->route("home")->with('danger', 'Sorry there is nothing from wish list !');
        }
        return view("jstore.wishlist",['wishlist'=>$wishlist]);
    }
    public function addToWishList(Request $request, $productId): View|RedirectResponse{
        $this->wishService->addProductToWish($productId);
        return redirect()->route('wishlist');
    }
    public function removeFromWishList(Request $request, $productId): View|RedirectResponse{
        $this->wishService->removeProductFromWish($productId);
        return redirect()->route('wishlist');
    }
}
