<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SliderController extends Controller
{
    function add_slider(){
        $sliders = Slider::all();
        return view ('admin.slider.add_slider', [
            'sliders' => $sliders,
        ]);
    }

    function store_slider(Request $request){
        $photo = $request->slider_photo;
        $extension = $photo->extension();
        $file_name = uniqid().'.'.$extension;
        Image::make($photo)->save(public_path('uploads/slider/'. $file_name));
        Slider::insert([
            'slider_text' => $request->slider_text,
            'slider_photo' => $file_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Your Slider Add Successful');

    }
}
