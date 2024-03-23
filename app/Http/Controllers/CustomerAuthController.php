<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    function customer_login(){
        return view('frontend.customer.login');
    }

    function customer_register(){
        return view('frontend.customer.register');
    }

    function customer_ragister_post(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers',
            'password' => 'required|min:6',
            'password' => 'required',
        ]);

        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);

        if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('index');
        }
    }

    function customer_login_post(Request $request){
        if(Customer::where('email', $request->email)->exists()){
            if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('index');
            }else {
                return back()->with('pass', 'Incorrect Your Password');
            }
        }
        else{
            return back()->with('email', 'Incorrect Your Email');
        }
    }

    function customer_logout_post(Request $request){
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }

}
