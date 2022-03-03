<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));

    }

    public function AddSlider(){
        return view('admin.slider.create');
        }

        public function StoreSlider(Request $request){
            $validatedData = $request->validate(
                [
                    'title' => 'required|unique:sliders|min:4',
                    'description' =>'min:10',
                    'image' => 'required|mimes:jpg,jpeg,png',
    
                ],
                [
                    'title.required' => 'Please Input Slider Name',
                    'description.min' => 'Description More Than 10 Chars',
                    'image.required' => 'Image Required'
                ]
            );
    
            $slider_image = $request->file('image');
      
    
            $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920,1088)->save('image/slider/' . $name_gen);
            $last_img = 'image/slider/' . $name_gen;
            Slider::insert([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img ,
                'created_At' => Carbon::now()
                
    
            ]);
    
            return Redirect()->back()->with('success', 'Slider Inserted Successfully');
        }
            
        }
    

