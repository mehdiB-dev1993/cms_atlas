<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderStoreRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        $sliders = Slider::all();
        return view('admin.slider.list')->with('sliders',$sliders);
    }


    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {

        return view('admin.slider.create');
    }

    public function store(SliderStoreRequest $request): \Illuminate\Http\RedirectResponse
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


    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $slider = Slider::find($request->id);
        return response()->json($slider);
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $slider = Slider::find($request->slider_id);
            $slider->title = $request->title;
            $slider->link = $request->link;
            $slider->banner = $request->banner;
            $slider->status = $request->has('status') ? 1 : 0;

            if ($request->hasFile('banner')) {
                $originalName = $request->banner->getClientOriginalName();
                $banner = $request->banner->storeAs('uploads/slider', $originalName, 'public');
                $slider->banner = $banner;
            }
            $slider->save();

            return response()->json(['success'=>'slider updated successfully']);

        }
        catch (\Exception $e)
        {
            return  response()->json(['error' => $e->getMessage()]);

        }


    }
}
