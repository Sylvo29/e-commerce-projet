<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderFormRequest;
use Illuminate\Support\Facades\Storage;
// use Barryvdh\DomPDF\PDF;
use PDF;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);
        return view('orders/index', ['orders' => $orders]);
    }

    public function show($id): View
    {
        $order = Order::findOrFail($id);

        return view('orders/show',['order' => $order]);
    }
    public function create(): View
    {
        return view('orders/create');
    }

    public function edit($id): View
    {
        $order = Order::findOrFail($id);
        return view('orders/edit', ['order' => $order]);
    }

    public function store(OrderFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        

        $order = Order::create($data);
        return redirect()->route('admin.order.show', ['id' => $order->id]);
    }

    public function update(Order $order, OrderFormRequest $req)
    {
        $data = $req->validated();

        

        $order->update($data);

        return redirect()->route('admin.order.show', ['id' => $order->id]);
    }

    public function updateSpeed(Order $order, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $order->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Order $order)
    {
        
        $order->delete();

        return [
            'isSuccess' => true
        ];
    }

    public function downloadInvoice($id)
    {
         
        try {
            $fullOderInfo = Order::findOrFail($id);
            //Generer le PDF
            $imgLogo1 = asset('assets/images/Facture Payer 1.png') ;
            $imgLogo2 = asset('assets/images/Facture Payer 3.jpg') ;
            // dd($fullOderInfo->isPaid);
            // return view('orders/facture', [
            //     'fullOderInfo'=> $fullOderInfo,
            //     'imgLogo1'=> $imgLogo1,
            //     'imgLogo2'=> $imgLogo2,
            // ]);

            $pdf = PDF::loadView('orders/facture', [
                'fullOderInfo'=> $fullOderInfo  
            ]);
            return $pdf->download('facture'.$fullOderInfo->clientName.'.pdf');

        } catch (\Exception $e) {
           throw new \Exception(abort(404));
           
        }
    }
}