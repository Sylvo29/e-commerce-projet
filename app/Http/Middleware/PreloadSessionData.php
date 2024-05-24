<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Megacollection;
use App\Models\Setting;
use App\Models\Social;
use App\Services\CartService;
use Closure;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PreloadSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $session = $request->session();
        $pages = [
            'headPages' => Page::where("isHead", 'true')->get(),
            'footPages' => Page::where("isFoot", 'true')->get(),
        ];
        $mega_menus = [
            'categories' => Category::where("IsMega", 'true')->take(4)->get(),
            'footerPage' => Category::where("IsFoot", 'true')->take(4)->get(),
            'mega_collection' => Megacollection::all(),
        ];
        Session::put('pages', $pages);
        Session::put('mega_menus', $mega_menus);
        Session::put('setting', Setting::first());
        Session::put('socials', Social::all());
        Session::put('cart_details', (new CartService())->getCartDetails());

        return $next($request);
    }
}
