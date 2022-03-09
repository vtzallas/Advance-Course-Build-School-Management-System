<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|unique:sliders|min:4',
                'description' => 'min:10',
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
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_gen);
        $last_img = 'image/slider/' . $name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_At' => Carbon::now()


        ]);

        return Redirect()->back()->with('success', 'Slider Inserted Successfully');
    }

    public function Edit($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function Update(Request $request, $id)
    {

        $validatedData = $request->validate(
            [
                'title' => 'required|min:4',
                'description' => 'min:10',
                'image' => 'mimes:jpg,jpeg,png',

            ],
            [
                'title.required' => 'Please Input Slider Name',
                'description.min' => 'Description More Than 10 Chars',

            ]
        );
        $old_image = $request->old_image;
        $slider_image = $request->file('image');

        if ($slider_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($slider_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location . $img_name;
            $slider_image->move($up_location, $img_name);

            unlink($old_image);
            Slider::find($id)->update([

                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'updated_at' => Carbon::now()


            ]);


            return Redirect()->back()->with('success', 'Slider Updated Successfully');
        } else {

            Slider::find($id)->update([

                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now()


            ]);


            return Redirect()->back()->with('success', 'Slider Updated Successfully');
        }
    }

    public function Delete($id)
    {
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);
        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider Deleted Successfully');
    }
}
