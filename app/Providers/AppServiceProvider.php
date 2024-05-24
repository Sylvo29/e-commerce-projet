<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        view()->composer("*", function ($view) {

            $view->with("calculateReduction", function(Product $product) {
                return number_format((($product->regularPrice - $product->soldePrice) / $product->regularPrice) * 100, 0);
            });
            $view->with("format_price", function($soldePrice) {
                return  number_format($soldePrice, 2, ',', ' ') . ' €' ;
            });
            $view->with("site_title", function() {
                return   "| ". Session::get('setting')?->name ;
            });
            $view->with("get_image", function($product) {
                return   Storage::url($product['imageUrls'][0]) ;
            });
        });
    }
}
