<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Carbon\Carbon;


class AboutController extends Controller
{
    public function HomeAbout(){
        $homeabout =HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeabout'));

    }

    public function AddAbout()
    {
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|unique:home_abouts|min:4',
                'short_dis' => 'required|min:10',
                'long_dis' => 'required|min:10',

            ],
            [
                'title.required' => 'Please Input About Name',
                'short_dis.min' => 'Short Description More Than 10 Chars',
                'long_dis.min' => 'Long Description More Than 10 Chars',
            ]
        );

    
        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now()

        ]);

        return Redirect()->back()->with('success', 'About Inserted Successfully');
    }
}
