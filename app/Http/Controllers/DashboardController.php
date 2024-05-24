<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();
        
        return view("jstore.dashboard", ['user' => $user]);
    }



    public function createAddress()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();
        return view("jstore.dashboard", ["user" => $user, 'action' => 'address.add']);
    }
    public function addressEdit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();
        $address = Address::findOrFail($id);
        return view("jstore.dashboard", ["user" => $user, "address" => $address, 'action' => 'address.edit']);
    }

    public function update(Address $address, Request $request)
    {
        $isRequired = $request->isMethod("POST") ? "required|" : "";
        $request->validate([
            'name' => $isRequired . 'string',
            'clientName' => $isRequired . 'string',
            'street' => $isRequired . 'string',
            'codePostal' => $isRequired . 'string',
            'city' => $isRequired . 'string',
            'state' => $isRequired . 'string',
            'moreDetails' => 'string',
            'addressType' => $isRequired . 'string',
        ]);

        $address->update([
            'name' => $request->name,
            'clientName' => $request->clientName,
            'street' => $request->street,
            'codePostal' => $request->codePostal,
            'city' => $request->city,
            'state' => $request->state,
            'moreDetails' => $request->moreDetails,
            'addressType' => $request->addressType,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('dashboard.address')->with('success', 'Address has been updated !');

    }
    public function store(Request $request)
    {
        $isRequired = $request->isMethod("POST") ? "required|" : "";
        $request->validate([
            'name' => $isRequired . 'string',
            'clientName' => $isRequired . 'string',
            'street' => $isRequired . 'string',
            'codePostal' => $isRequired . 'string',
            'city' => $isRequired . 'string',
            'state' => $isRequired . 'string',
            'moreDetails' => 'string',
            'addressType' => $isRequired . 'string',
        ]);

        Address::create([
            'name' => $request->name,
            'clientName' => $request->clientName,
            'street' => $request->street,
            'codePostal' => $request->codePostal,
            'city' => $request->city,
            'state' => $request->state,
            'moreDetails' => $request->moreDetails,
            'addressType' => $request->addressType,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('dashboard.address')->with('success', 'New address has been created !');

    }

    public function updateProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('dashboard.account')->with('success', 'Profile has been updated !');
    }
    public function updateUserPassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();

        $request->validate([
            'password' => 'required|string|min:8',
            'npassword' => 'required|min:8|different:password',
            'cpassword' => 'required|same:npassword'
        ],
            [
                'npassword.required' => 'The new password field is required.',
                'cpassword.required' => 'The confirmation password field is required.',
                'password.min' => 'The password must be at least 8 characters.',
                'npassword.min' => 'The new password must be at least 8 characters.',
                'npassword.different' => 'The new password must be different from the current password.',
                'cpassword.same' => 'The confirmation password does not match.',
            ]);

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withInput()->withErrors([
                'password' => 'The current password is incorrect.'
            ]);
        }

        $user->password = Hash::make($request->npassword);


        $user->save();

        return redirect()->route('dashboard.account')->with('success', 'Your password has been updated !');
    }

    public function delete($id)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();
        $address = Address::findOrFail($id);
        if ($address->user_id !== $user->id) {
            return redirect()->route('home');
        }
        $address->delete();
        return redirect()->route('dashboard.address')->with('success', 'Address has been deleted !');
    }

    // public function findOrderUser()
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('home');
    //     }
    //     $user = Auth::user();
    //     $orderInfo = Order::findOrFail($user->id);
    //     dd($orderInfo);
    //     return view("jstore.dashboard",[
    //         'user' => $user,
    //         'orderInfo' => $orderInfo,

    //     ]);

    // }
}
