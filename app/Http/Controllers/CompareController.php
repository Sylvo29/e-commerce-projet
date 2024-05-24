<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\CompareService;
use Illuminate\Http\RedirectResponse;

class CompareController extends Controller
{
    //
    public function index(Request $request, CompareService $compareService):View|RedirectResponse {
        $compare = $compareService->getComparedProductsDetails();
        if(empty($compare)){
            return redirect()->route("home")->with('danger', 'Sorry there is nothing to compare !');
        }
        return view("jstore.compare",['compare'=>$compare]);
    }
    public function addToCompare(Request $request, $productId, CompareService $compareService):View|RedirectResponse{
        $compareService->addProductToCompare($productId);
        return redirect()->route('compare');
    }
    public function removeFromCompare(Request $request, $productId, CompareService $compareService):View|RedirectResponse{
        $compareService->removeProductFromCompare($productId);
        return redirect()->route('compare');
    }
}
