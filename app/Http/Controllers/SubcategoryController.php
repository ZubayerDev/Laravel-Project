<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    function subcategory(){
        $categories = Category::all();
        return view('admin.category.add_subcategory', [
            'categories' => $categories,
        ]);
    }

    function subcategory_store(Request $request){
        $slug = Str::lower(str_replace(' ','-', $request->subcategory_name)).random_int(200000, 999999);
        Subcategory::insert([
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_code'=>$request->subcategory_code,
            'subcategory_slug' => $slug,
            'subcategory_status'=>$request->subcategory_status,
            'category_id'=>$request->category_id,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Your Subcategory Add Successfully');
    }

    function allsubcategory_store(){
        $categories = Category::all();
        return view('admin.category.all_subcategory', [
            'categories' => $categories,
        ]);
    }

    function delete_subcategory($id){
        Subcategory::find($id)->delete();
        return back()->with('success', 'Your Subcategory Item Deleted');
    }

    function edit_subcategory($id){
       $subcategory = Subcategory::find($id);
       $categories = Category::all();
       return view('admin.category.edit_subcategory', [
        'subcategory' => $subcategory,
        'categories' => $categories,
       ]);
    }

    function update_subcategory(Request $request, $id){
        Subcategory::find($id)->update([
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_code'=>$request->subcategory_code,
            'subcategory_status'=>$request->subcategory_status,
        ]);
        return back()->with('success', 'Your Subcategory Update Success');
     }
}
