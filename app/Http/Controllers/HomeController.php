<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactFormRequest;

class HomeController extends Controller
{
    //
    public function index(): View
    {
        //  $user = Auth::user();

        // $user->roles()->sync([1,2,3]);

        $banners = Banner::all();
        $collections = Collection::all();

        $newArrivals = Product::where("isNewArrival", "true")->orderBy("id", "desc")->get();
        $bestSellers = Product::where("isBestSeller", "true")->orderBy("id", "desc")->get();
        $featured = Product::where("isFeatured", "true")->orderBy("id", "desc")->get();
        $specialOffers = Product::where("isSpecialOffer", "true")->orderBy("id", "desc")->get();

        return view('home', [
            'banners' => $banners,
            'collections' => $collections,
            'featured' => $featured,
            'specialOffers' => $specialOffers,
            'bestSellers' => $bestSellers,
            'newArrivals' => $newArrivals,
        ]);
    }

    public function showPage(string $slug): View
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('jstore.page', ['page' => $page]);
    }
    public function showProduct(string $slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $stock = $product->stock == 0 ? 'Unavailable' : 'Available';
        return view('jstore.product', [
            'product' => $product,
            'stock' => $stock

        ]);
    }
    public function contact(Request $request): View
    {
        return view('jstore.contact');
    }

    public function shop(Request  $req): View
    {
        $sort = $req->input('sort');
        $showing = $req->input('showing');
        $category_id = $req->input('category_id');
        $pageLimit = 8;

        if($showing && is_numeric($showing)){
            $pageLimit = (int) $showing;
        }


        $products = Product::query();
        $categories = Category::all();

        if($sort){
            $filter = $sort === 'price-desc' ? 'desc' : 'asc';
            $products = $products->orderBy('soldePrice', $filter);
        }
        if(($category_id && is_numeric($category_id)) || $category_id === 'all'){

            if($category_id !== 'all'){
                $category_id = (int) $category_id;

                $products->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                });

            }
        }


         $products = $products->paginate($pageLimit)->onEachSide(1);

        return view('jstore.shop', ['products' => $products, 'categories' => $categories]);
    }

    public function searchProduct(Request $request)
    {
        $q = request()->input('q');
        // dd($q);
        // $products = Product::all();
        $search = Product::where('name', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->paginate(6);
                // dd($search);
        return view('jstore.search',['search' => $search]);
    }


}
