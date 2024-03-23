<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function addto_cart(Request $request, $product_id){
        Cart::insert([
            'customer_id' => Auth::guard('customer')->id(),
            'product_id' => $product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('cart', 'Your Cart Successfully Add');
    }

    function cart_remove($cart_id){
        Cart::find($cart_id)->delete();

        return back()->with('cart_delete', 'Your Cart Successfully Add');
    }
}
