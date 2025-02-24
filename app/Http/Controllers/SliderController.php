<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderStoreRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.list')->with('sliders',$sliders);
    }


    public function create()
    {

        return view('admin.slider.create');
    }

    public function store(SliderStoreRequest $request)
    {
        $request->validated();
        try
        {
            if ($request->hasFile('banner')) {
                $banner = $request->file('banner')->store('uploads/banner', 'public');
            }

               Slider::create([
                'title' =>   $request->title,
                'link' => $request->link,
                'banner' =>  $banner,
                'status' => $request->has('status') ? 1 : 0
            ]);

            return redirect()->back()->with('success','slider added successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }


    public function edit(Request $request)
    {
        $slider = Slider::find($request->id);
        return response()->json($slider);
    }

    public function update(Request $request)
    {
        try {

            $slider = Slider::find($request->slider_id);

            if ($request->hasFile('banner')) {
                $originalName = $request->banner->getClientOriginalName();
                $banner = $request->banner->storeAs('uploads/slider', $originalName, 'public');


                $slider->update([
                    'title' =>   $request->title,
                    'link' => $request->link,
                    'banner' =>  $banner,
                    'status' => $request->has('status') ? 1 : 0
                ]);

            }else
            {
                $slider->update([
                    'title' =>   $request->title,
                    'link' => $request->link,
                    'status' => $request->has('status') ? 1 : 0
                ]);
            }

            return response()->json(['success'=>'slider updated successfully']);

        }
        catch (\Exception $e)
        {
            return  response()->json(['error' => $e->getMessage()]);

        }


    }
}
