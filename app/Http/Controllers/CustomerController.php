<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    function customer_profile(){
        $countries = Country::all();
        $city = City::all();
        return view('frontend.customer.profile', [
            'countries' => $countries,
            'city' => $city,
        ]);
    }

    function get_city(Request $request){
        $str = '';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }

        echo $str;
    }

    function customer_profile_update (Request $request){
        if($request->password == ''){
            if($request->photo == ''){
                Customer::find(Auth::guard('customer')->id())->update([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'zip' => $request->zip,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                ]);

                return back()->with('success','Your Profile Is Successfully Update');
            }else {
                if(Auth::guard('customer')->user()->photo != null){
                    $delete_from = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo);
                    unlink($delete_from);
                }

                $photo = $request->photo;
                $extention = $photo->extension();
                $file_name = uniqid().'.'.$extention;
                Image::make($photo)->save(public_path('uploads/customer/'. $file_name));
                Customer::find(Auth::guard('customer')->id())->update([
                    'name' => $request->name,
                    'country_id' => $request->country_id,
                    'city_id' => $request->city_id,
                    'zip' => $request->zip,
                    'email' => $request->email,
                    'phpne' => $request->phone,
                    'address' => $request->address,
                    'photo' => $file_name,
                    ]);

                    return back()->with('success','Your Profile Is Successfully Update');
            }
        }
        else {
            if($request->photo == ''){

                Customer::find(Auth::guard('customer')->id())->update([
                    'name' => $request->name,
                    'country_id' => $request->country_id,
                    'city_id' => $request->city_id,
                    'zip' => $request->zip,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'address' => $request->address,
                    ]);
                    return back()->with('success','Your Profile Is Successfully Update');
            }else{

                if(Auth::guard('customer')->user()->photo != null){
                    $delete_from = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo);
                    unlink($delete_from);
                }

                $photo = $request->photo;
                $extention = $photo->extension();
                $file_name = uniqid().'.'.$extention;
                Image::make($photo)->save(public_path('uploads/customer/'. $file_name));
                Customer::find(Auth::guard('customer')->id())->update([
                    'name' => $request->name,
                    'country_id' => $request->country_id,
                    'city_id' => $request->city_id,
                    'zip' => $request->zip,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'photo' => $file_name,
                    ]);

                    return back()->with('success','Your Profile Is Successfully Update');
            }

        }
    }
}
