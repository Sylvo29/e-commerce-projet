<?php

namespace App\Http\Controllers;

use App\Models\Orderdetails;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderdetailsFormRequest;
use Illuminate\Support\Facades\Storage;

class OrderdetailsController extends Controller
{
    public function index(): View
    {
        /**Paginate Orderdetails */
        $paginateOrderdetails = Orderdetails::paginate(5);
        $orderdetails = Orderdetails::orderBy('created_at', 'desc')->paginate(5);
        return view('orderdetails/index', ['orderdetails' => $orderdetails, 'paginateOrderdetails' => $paginateOrderdetails]);
    }

    public function show($id): View
    {
        $orderdetails = Orderdetails::findOrFail($id);

        return view('orderdetails/show',['orderdetails' => $orderdetails]);
    }
    public function create(): View
    {
        return view('orderdetails/create');
    }

    public function edit($id): View
    {
        $orderdetails = Orderdetails::findOrFail($id);
        return view('orderdetails/edit', ['orderdetails' => $orderdetails]);
    }

    public function store(OrderdetailsFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        

        $orderdetails = Orderdetails::create($data);
        return redirect()->route('admin.orderdetails.show', ['id' => $orderdetails->id]);
    }

    public function update(Orderdetails $orderdetails, OrderdetailsFormRequest $req)
    {
        $data = $req->validated();

        

        $orderdetails->update($data);

        return redirect()->route('admin.orderdetails.show', ['id' => $orderdetails->id]);
    }

    public function updateSpeed(Orderdetails $orderdetails, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $orderdetails->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Orderdetails $orderdetails)
    {
        
        $orderdetails->delete();

        return [
            'isSuccess' => true
        ];
    }

    
}