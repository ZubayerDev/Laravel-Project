<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Gallery;



class ProductController extends Controller
{
    function addproduct(){
        $brand = Brand::all();
        $category = Category::all();
        $subcategory = Subcategory::all();
        $tags = tag::all();
        return view('admin.product.add_product',[
            'brands' => $brand,
            'categories' => $category,
            'subcategories' => $subcategory,
            'tags' => $tags,
        ]);
    }

    function getSubcategory(Request $request){
        $string ='<option value="">Select</option>';
        $subcategories = Subcategory::where('category_id',$request->category_id)->get();
        foreach($subcategories as $subcate){
            $string .= '<option value="'.$subcate->id.'">'.$subcate->subcategory_name.'</option>';
        }

        echo $string;
    }

    function product_store(Request $request){
        $request->validate([
            'product_name' => 'required',
            'product_brand' => 'required',
            'category_name' => 'required',
            'subcategory' => 'required',
            'product_photo' => 'required',
        ],[
            'product_name.required' => 'Product Name Mustbe Fillable',
            'product_brand.required' => 'Please Select Your Brand',
            'category_name.required' => 'Please Select Your Main Category',
            'subcategory.required' => 'Please Select Your  SubCategory',

            'product_photo.required' => 'Please Insert Your Photo',
        ]);

        $tags = $request->tag_id;
        $after_implode = implode(',',$tags);
        $slug = Str::lower(str_replace('','-',$request->product_name)).'.'.random_int(200000, 999999);

        $product_img = $request->product_photo;
        $extension = $product_img->extension();
        $file_name = Str::lower(str_replace('','-',$request->product_brand)).'-'.random_int(2000, 9999).'.'.$extension;
        Image::make($product_img)->save(public_path('uploads/product/preview/'. $file_name));
        $product_id = Product::insertGetId([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'product_brand' => $request->product_brand,
            'category_name' => $request->category_name,
            'subcategory' => $request->subcategory,
            'sku' => $request->sku,
            'discount' => $request->discount,
            'short_desp' => $request->short_desp,
            'product_photo' => $file_name,
            'seo_tag' => $after_implode,
            'pruduct_slug' => $slug,
            'long_desp' => $request->long_desp,
            'add_info' => $request->add_info,
            'created_at'=>Carbon::now(),
        ]);

        $gallries = $request->multiple_photo;
        foreach($gallries as $gal){
            $extension2 = $gal->extension();
            $file_name2 = Str::lower(str_replace('','-',$request->product_brand)).'-'.random_int(2000, 9999).'.'.$extension2;
            Image::make($gal)->save(public_path('uploads/product/gallery/'. $file_name2));

            Gallery::insert([
                'product_id' => $product_id,
                'multiple_photo' => $file_name2,
                'created_at' => Carbon::now(),
            ]);
        }

        return back()->withSuccess('Product Add Successfully');
    }

    function product_list(){
        $products = Product::all();
        return view('admin.product.product_list', [
            'products' => $products,
        ]);
    }

    function product_view($id){
        $product_info = Product::find($id);
        $galleries = Gallery::where('product_id', $id)->get();
        return view('admin.product.product_view', [
            'product_info' => $product_info,
            'galleries' => $galleries,
        ]);
    }

    function product_update($id){
        $product = Product::find($id);
        $brand = Brand::all();
        $category = Category::all();
        $subcategory = Subcategory::all();
        $tags = tag::all();
        return view('admin.product.product_edit', [
            'product' => $product,
            'brands' => $brand,
            'categories' =>$category,
            'subcategories' => $subcategory,
            'tags' => $tags,
        ]);
    }

    function product_edit_all(Request $request, $id){

        $product_img = $request->product_photo;
        $extension = $product_img->extension();
        $file_name = Str::lower(str_replace('','-',$request->product_brand)).'-'.random_int(2000, 9999).'.'.$extension;
        Image::make($product_img)->save(public_path('uploads/product/preview/'. $file_name));

        $product_img = Product::find($id);
        $delete_from = public_path('uploads/product/preview/' .$product_img->product_photo);
        unlink($delete_from);

        $tags = $request->tag_id;
        $after_implode = implode(',',$tags);

        Product::find($id)->update([
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'product_brand' => $request->product_brand,
            'category_name' => $request->category_name,
            'subcategory' => $request->subcategory,
            'sku' => $request->sku,
            'discount' => $request->discount,
            'short_desp' => $request->short_desp,
            'product_photo' => $file_name,
            'seo_tag' => $after_implode,
            'long_desp' => $request->long_desp,
            'add_info' => $request->add_info,

        ]);

            $galleries = $request->multiple_photo;
            foreach($galleries as $gallery){

                $gallery_extension = $gallery->extension();
                $gallery_file_name = Str::lower(str_replace('','-',$request->product_brand)).'-'.random_int(2000, 9999).'.'. $gallery_extension;
                Image::make($gallery)->resize(700, 700)->save(public_path('uploads/product/gallery/'.$gallery_file_name));
                Gallery::insert([
                    'product_id'=> $id,
                    'multiple_photo'=> $gallery_file_name,
                    'created_at'=> Carbon::now(),
                ]);

            }
        return back()->withSuccess('Your Update Is Successfull');
    }

    function product_delete($id){
        $product_delete = Product::find($id);
        $delete_from = public_path('uploads/product/preview/'.$product_delete->product_photo);
        unlink($delete_from);
        Product::find($id)->delete();

        $product_id = Gallery::where('product_id', $id)->get();
        foreach($product_id as $product_image){
        $product_image = public_path('uploads/product/gallery/'.$product_image->multiple_photo);
        unlink($product_image);
        Gallery::find($product_image)->delete();
        }
        return back()->withDelsuccess('Your Prdduct Is Successfully Deleted');
    }

}
