<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function add_category(){
        return view('admin.category.add_category');
    }

    function category_store(Request $request)
    {
        $request->validate([
          'category_name' => 'required|unique:categories',
          'category_status' => 'required',
          'category_photo' => ['required','mimes:jpg,png,jpeg', 'max:1024'],

        ]);

        $slug = Str::lower(str_replace(' ','-', $request->category_name)).random_int(200000, 999999);
        $photo = $request->category_photo;
        $extension = $photo->extension();
        $file_name = uniqid().'.'.$extension;

        Image::make($photo)->save(public_path('uploads/category/' .$file_name));

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'category_status' => $request->category_status,
            'category_code' => $request->category_code,
            'category_photo' => $file_name,
            'created_at' => Carbon::now(),
        ]);


        return back()->with('success', 'Category Successfully Add');
    }

    function all_category(){
        $categories = Category::all();
        return view('admin.category.all_category', [
            'categories' => $categories,
        ]);

    }

    function edit_category($id){

        $category = Category::find($id);
        return view('admin.category.category_edit', [
            'category'=>$category,
        ]);
    }

    function update_category(Request $request, $id){
        $img = $request->category_photo;

        if($img == ''){
            Category::find($id)->update([
                'category_name' => $request->category_name,
                'category_code' => $request->category_code,
            ]);
            return back()->with('success', 'Category Successfully Update');
        } else {
            $category = Category::find($id);
            $delete_from = public_path('uploads/category/'.$category->category_photo);
            unlink($delete_from);

            $extension = $img->extension();
            $file_name = uniqid().'.'.$extension;

            Image::make($img)->save(public_path('uploads/category/' .$file_name));

            Category::find($id)->update([
                'category_name'=> $request->category_name,
                'category_code'=> $request->category_code,
                'category_photo'=> $file_name,
            ]);

            return back()->with('success', 'Category Successfully Update');
        }
    }

    function delete_category($id){
            Category::find($id)->delete();
            return back()->with('del', 'Category Successfully Update');

    }

    function status_category(Request $request, $id){
        Category::find($id)->update([
            'category_status' => $request->id,

        ]);
        return back()->with('success', 'Status Successfully Update');
    }

    // ////Soft Deleting ///////////////////////
    function trash_category(){
        $category = Category::onlyTrashed()->get();
        return view('admin.category.soft_delete', [
            'categories'=> $category,
        ]);
    }
    // This Condition with Photo & without photo delet
    function restore_category($id){
        Category::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'Your Data Restored');
    }
    function force_category_delete(Request $request, $id){
           $img = $request->category_photo;
        if($img == ''){
            Category::onlyTrashed()->find($id)->forceDelete();
            Subcategory::where('category_id', $id)->delete();
             return back()->with('success', 'Permanant Delete Successful');

        }else {
        $category = Category::onlyTrashed()->find($id);
        $delete_from = public_path('uploads/category/'.$category->category_photo);
        unlink($delete_from);

        Category::onlyTrashed()->find($id)->forceDelete();
        Subcategory::where('category_id', $id)->delete();
        return back()->with('success', 'Permanant Delete Successful');
        }
    }

    function checked_category_delete(Request $request){
            $category = $request->category_id;
            foreach($category as $cat_id){
                Category::find($cat_id)->delete();
            }
            return back()->with('success', 'Delete All Successful');

    }

    function checked_category_restore_delete(Request $request){
        $categoryall = $request->category_id;

        foreach($categoryall as $cat_id){
            if($request->btn == 'restore'){
                Category::onlyTrashed()->find($cat_id)->restore();
                return back()->with('success', 'Restore Successful');
            } else {
                $category = Category::onlyTrashed()->find($cat_id);
                $delete_from = public_path('uploads/category/'.$category->category_photo);
                unlink($delete_from);
                $category->forceDelete();
                return back()->with('success', 'Permanant Successful');
            }

        }
    }
}

