<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class userController extends Controller
{
    function edit_user(){
        return view('admin.user.edit_profile');
    }



    function update_profile(Request $request)
    {
        User::find(Auth::id())->update([
            'name' => $request->name,
        ]);


        $request->validate([
            'email'=> 'unique:users',
        ]);

        return back()->with('success', 'Users Update Successfully');
    }

    function add_user(Request $request){
     User::insert([
        'name' => $request->user_name,
        'email' => $request->user_email,
        'password' => bcrypt($request->user_password),
        'created_at' => Carbon::now(),
     ]);
        return back()->withSuccess2('Your User Successfully Created');
    }

    function user_list(){
        $user = User::all();
        return view('admin.user.user_list', compact('user'));
    }

    function update_password(Request $request)
    {
        $request->validate([
            'curren_password' => 'required',
            'password' => ['required', 'confirmed'],
            'password_confirmation' => 'required',
        ]);

        if(password_verify($request->curren_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password'=> bcrypt($request->password),
            ]);
            return back()->with('pass_success', 'Password Update Successfully');
        } else {
            return back()->with('pass_error', 'Current Password Not Match');
        }
    }

    function update_picture(Request $request){
        $request->validate([
            'image' => 'required',
            'image' => 'mimes:jpg',
            'image' => 'max:2024',
        ],[
            'image.required'=>'Please Insert Your profile Image',
        ]);

        if(Auth::user()->photo != null){
            $delete_from = public_path('uploads/users/'.Auth::user()->photo);
            unlink($delete_from);
        }

        $image = $request->image;
        $extension = $image->extension();
        $file_name = Auth::id().'.'.$extension;
       Image::make($image)->resize(300, 200)->save(public_path('uploads/users/'.$file_name));
       User::find(Auth::id())->update([
        'photo' => $file_name,
       ]);

       return back()->with('picture_update', 'Your Profile Picture Successfully Update');
    }

    function user_delete($user_id)
    {

        $user = User::find($user_id);
        $delete_from = public_path('uploads/users/'.$user->photo);
        unlink($delete_from);

        User::find($user_id)->delete();
        return back()->with('success', 'Your Userdata Successfully Delete');
    }
}
