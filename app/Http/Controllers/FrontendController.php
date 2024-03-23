<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\User;

class FrontendController extends Controller
{
    function contact()
    {
        return view('contact');
    }

    function about()
    {
        $users = user::all();
        return view('about', compact('users'));

    }

    function index(){
        $categpries = Category::all();
        $product = Product::all();
        $letest_product = Product::latest()->take(3)->get();
        $slider = Slider::all();
        return view('frontend.index', [
            'categories' => $categpries,
            'products' => $product,
            'slider' => $slider,
            'letest_product' => $letest_product,
        ]);
    }

    function product_details($pruduct_slug){
        $product = Product::where('pruduct_slug',$pruduct_slug)->get();
        $product_id = $product->first()->id;
        $product_info = Product::find($product_id);
        $gallery = Gallery::where('product_id', $product_id)->get();
        $available_colors = Inventory::where('product_id', $product_id)
        ->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')
        ->get();
        $available_size = Inventory::where('product_id', $product_id)
        ->groupBy('size_id')
        ->selectRaw('count(*) as total, size_id')
        ->get();
        return view('frontend.product_details', [
            'product_info' => $product_info,
            'gallery' => $gallery,
            'available_colors' => $available_colors,
            'available_size' => $available_size,
        ]);
    }

    function getsize(Request $request){
     $sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
     $str = '';
     foreach($sizes as $size){
        if($size->rel_to_size->size_name == 'NA'){
            $str .= '<li class="color"><input class="size_id"  id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
            <label for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label>
        </li>';
        } else {
            $str .= '<li class="color"><input class="size_id"  id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
            <label for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label>
        </li>';
        }
     }
     echo $str;
    }

    function getquantity(Request $request){
        $quantity = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;
        $str = '<h4>In Stock:'.$quantity.'</h4>';
        echo $str;
    }

    function getprice (Request $request){
        $str = '';
        $product = Product::find($request->product_id);
        $price = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->price;

        $after_discount = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->after_discount;
        if($product->discount){
            $str = '<span class="present-price">&#2547;'.$price.'</span>
            <del class="old-price">&#2547;'.$after_discount.'</del>';
        }
        else{
            $str = '<span class="present-price">&#2547;'.$price.'</span>';
        }
        echo $str;
    }

    function category_all($category_slug){
        $cat = Category::where('category_slug', $category_slug)->get();
        $cate_id = $cat->first()->id;
        $cat_info = Category::find($cate_id);
        $product = Product::where('category_name', $cate_id)->get();
        return view('frontend.category_all', [
            'cat_info' => $cat_info,
            'product' => $product,
        ]);
    }


    function subcategory_all($subcategory_slug){
        $sub_cate = Subcategory::where('subcategory_slug', $subcategory_slug)->get();
        $subcate_id = $sub_cate->first()->id;
        $subcate_info = Subcategory::find($subcate_id);
        $product = Product::where('subcategory', $subcate_id)->get();
        return view('frontend.subcategory_all', [
            'subcategory' => $subcate_info,
            'product' => $product,
        ]);
    }

    function offer_product(){
        $product_off = Product::all();
        return view('frontend.offer_page', [
            'product_off' => $product_off,
        ]);
    }


    function half_offer_product(){
        $half_product_off = Product::all();
        return view('frontend.half_product_off', [
            'half_product_off' => $half_product_off,
        ]);
    }

}
