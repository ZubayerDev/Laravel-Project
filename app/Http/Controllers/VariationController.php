<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    function add_variation(){
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.add_variation', [
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
    }

    function add_color(Request $request){
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);
        return back()->withSuccess('Your Color Successfully Add');
    }

    function add_size(Request $request){
        Size::insert([
            'size_name' => $request->size_name,
        ]);
        return back()->withSuccess2('Your Size Successfully Add');
    }

    function add_inventory($id){
        $colors = Color::all();
        $sizes = Size::all();
        $products = Product::find($id);
        $inventories = Inventory::where('product_id', $id)->get();
        return view('admin.product.add_inventory', [
            'sizes' => $sizes,
            'colors' => $colors,
            'products' => $products,
            'inventories' => $inventories,
        ]);
    }

    function inventory_store(Request $request, $id){
        $product = Product::find($id);
        if(Inventory::where('product_id', $id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            Inventory::where('product_id', $id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back();
        } else {
            Inventory::insert([
                'product_id' =>$id,
                'color_id' =>$request->color_id,
                'size_id' =>$request->size_id,
                'quantity' =>$request->quantity,
                'price' =>$request->price,
                'after_discount' =>$request->price - $request->price / 100 * ($product->discount),
            ]);

            return back()->withSuccess("Your Inventory Add Successfully");
        }
    }

    function color_delete($id){
        Color::find($id)->delete();
        return back()->withDelsuccess("Color Successfully Deleted");
    }

    function size_delete($id){
        Size::find($id)->delete();
        return back()->withSizeDelsuccess("Size Successfully Deleted");
    }
}
