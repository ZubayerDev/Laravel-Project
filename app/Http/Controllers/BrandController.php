<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    function brand(){
        $brands = Brand::all();
        return view('admin.brand.brand',[
            'brands' => $brands,
        ]);
    }

    function brand_store(Request $request){
        $photo = $request->brand_photo;
        $extension = $photo->extension();
        $file_name = uniqid().'.'.$extension;
        Image::make($photo)->save(public_path('uploads/brand/'. $file_name));
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_photo' => $file_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Your Brand Add Successful');
    }

    function brand_delete($id){
    $brands = Brand::find($id);
    $delete_from = public_path('uploads/brand/'.$brands->brand_photo);
    unlink($delete_from);

    Brand::find($id)->forceDelete();
    return back()->with('success', 'Your Brand Add Successful');
    }
}
