<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddressFormRequest;

class AddressController extends Controller
{
    public function index(): View
    {
        $addresses = Address::orderBy('created_at', 'desc')->paginate(5);
        return view('addresses/index', ['addresses' => $addresses]);
    }

    public function show($id): View
    {
        $address = Address::findOrFail($id);

        return view('addresses/show',['address' => $address]);
    }
    public function create(): View
    {
        $users = User::all();
        return view('addresses/create', ['users'=> $users]);
    }

    public function edit($id): View
    {
        $address = Address::findOrFail($id);
        $users = User::all();
        return view('addresses/edit', ['address' => $address, 'users'=> $users]);
    }

    public function store(AddressFormRequest $req): RedirectResponse
    {
        $data = $req->validated();


        $address = Address::create($data);
        return redirect()->route('admin.address.show', ['id' => $address->id]);
    }

    public function update(Address $address, AddressFormRequest $req)
    {
        $data = $req->validated();



        $address->update($data);

        return redirect()->route('admin.address.show', ['id' => $address->id]);
    }

    public function updateSpeed(Address $address, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $address->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Address $address)
    {

        $address->delete();

        return [
            'isSuccess' => true
        ];
    }


}
