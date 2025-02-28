<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryStoreRequest;
use App\Models\Gallery;
use App\Models\GalleryItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        $data = Gallery::with('galleryItems')->paginate(5);
        return view('admin.gallery.list')->with('data',$data);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        return view('admin.gallery.create');
    }

    public function store(GalleryStoreRequest $request)
    {
        $request->validated();


        try
        {
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon')->store('uploads/icon', 'public');
            }
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
            }
            if ($request->hasFile('header_image')) {
                $header_image = $request->file('header_image')->store('uploads/header_image', 'public');
            }

            $gallery = Gallery::create([
                'name' =>   $request->name,
                'title' =>   $request->title,
                'description' =>   $request->description,
                'abstract' =>   $request->abstract,
                'text' =>  $request->text,
                'keywords' =>  $request->keywords,
                'icon' => $icon,
                'header_image' => $header_image,
                'thumbnail' =>   $thumbnail,
                'order' =>   $request->order,
                'status' => $request->has('status') ? 1 : 0
            ]);


            $GalleryItems = request()->only(['item_alt', 'item_description', 'item_link','item','item_order']);
            $items = [];
            foreach ($GalleryItems['item'] as $index => $img)
            {
                $originalName = $img->getClientOriginalName();
                $img = $img->storeAs('uploads/gallery', $originalName, 'public');

                $items[] = [
                    'gallery_id'   => $gallery->id,
                    'title'        => $originalName,
                    'description'  => $GalleryItems['item_description'][$index] ?? null,
                    'src'          => $img,
                    'alt'          => $GalleryItems['item_alt'][$index] ?? null,
                    'link'         => $GalleryItems['item_link'][$index] ?? null,
                    'order'        => $GalleryItems['item_order'][$index] ?? null,
                    'status'       => 1
                ];
            }

            //GalleryItems::insert($items);
            $gallery->galleryItems()->createMany($items);


            return redirect()->back()->with('success', 'Gallery created successfully');


        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }



    public function edit(Request $request)
    {

        $gallery =  Gallery::with('galleryItems')->find($request->id);
        return view('admin.gallery.edit')->with('gallery',$gallery);
    }


    public function update(Request $request)
    {


        try {
            $gallery = Gallery::find($request->gallery_id);
            if ($request->hasFile('thumbnail')) {

                $originalName = $request->thumbnail->getClientOriginalName();
                $thumbnail = $request->thumbnail->storeAs('uploads/gallery', $originalName, 'public');
                $gallery->thumbnail = $thumbnail;
            }
            if ($request->hasFile('icon')) {

                $originalName = $request->icon->getClientOriginalName();
                $icon = $request->icon->storeAs('uploads/icon', $originalName, 'public');
                $gallery->icon = $icon;
            }
            if ($request->hasFile('header_image')) {

                $originalName = $request->header_image->getClientOriginalName();
                $header_image = $request->header_image->storeAs('uploads/header_image', $originalName, 'public');
                $gallery->header_image = $header_image;
            }


            $gallery->name = $request->name;
            $gallery->title = $request->title;
            $gallery->description = $request->description;
            $gallery->abstract = $request->abstract;
            $gallery->text = $request->text;
            $gallery->keywords = $request->keywords;
            $gallery->order = $request->order;
            $gallery->status = ($request->has('status') ? 1 : 0);
            $gallery->save();
            /*******************************/


            if ($request->has('item')) {
                $GalleryItems = $request->only(['item']);


                foreach ($GalleryItems['item'] as $index => $itm) {

                    $gItem = $gallery->galleryItems()->find($index);


                    $gItem->gallery_id = $request->gallery_id;

                    $originalName = '';
                    if (isset($itm['src'][0])) {
                        $originalName = $itm['src'][0]->getClientOriginalName();
                        $src = $itm['src'][0]->storeAs('uploads/gallery', $originalName, 'public');
                        $gItem->src = $src;
                    }

                    $gItem->title = $originalName;

                    if (isset($itm['description'][0])) {

                        $gItem->description = $itm['description'][0];

                    }

                    if (isset($itm['alt'][0])) {
                        $gItem->alt = $itm['alt'][0];
                    }

                    if (isset($itm['link'][0])) {
                        $gItem->link = $itm['link'][0];
                    }

                    if (isset($itm['order'][0])) {
                        $gItem->order = $itm['order'][0];
                    }

                    $gItem->save();
                }


            }

            if ($request->has('item_src') && $request->has('item_alt') && $request->has('item_description') && $request->has('item_link') && $request->has('item_order'))
            {
                $GalleryItems = request()->only(['item_src', 'item_alt', 'item_description','item_link','item_order']);
                $items = [];
                foreach ($GalleryItems['item_src'] as $index => $img)
                {
                    $originalName = $img->getClientOriginalName();
                    $img = $img->storeAs('uploads/gallery', $originalName, 'public');

                    $items[] = [
                        'gallery_id'   => $gallery->id,
                        'title'        => $originalName,
                        'description'  => $GalleryItems['item_description'][$index] ?? null,
                        'src'          => $img,
                        'alt'          => $GalleryItems['item_alt'][$index] ?? null,
                        'link'         => $GalleryItems['item_link'][$index] ?? null,
                        'order'        => $GalleryItems['item_order'][$index] ?? null,
                        'status'       => 1
                    ];
                }

                //GalleryItems::insert($items);
                $gallery->galleryItems()->createMany($items);
            }


            return redirect()->back()->with(['success' => 'Gallery updated successfully']);


        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

    public function delete(Request $request)
    {
        try {
            $gallery = Gallery::find($request->gid);
            $gallery->galleryItems()->find($request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'gallery item deleted successfully'],200);
        }
        catch (\Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

}
