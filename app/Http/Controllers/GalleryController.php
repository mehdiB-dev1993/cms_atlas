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
        /*$data = Gallery::with('galleryItems')->get();*/
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
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
            }

            $gallery = Gallery::create([
                'title' =>   $request->title,
                'description' =>   $request->description,
                'thumbnail' =>   $thumbnail,
                'status' => $request->has('status') ? 1 : 0
            ]);


            $GalleryItems = request()->only(['item_alt', 'item_description', 'item_link','item']);
            $items = [];
            foreach ($GalleryItems['item'] as $index => $img)
            {
                /*$img =  $img->store('uploads/gallery', 'public');*/
                $originalName = $img->getClientOriginalName();
                $img = $img->storeAs('uploads/gallery', $originalName, 'public');

                $items[] = [
                    'gallery_id'   => $gallery->id,
                    'title'        =>$originalName,
                    'description'  => $GalleryItems['item_description'][$index] ?? null,
                    'src'          => $img,
                    'alt'          => $GalleryItems['item_alt'][$index] ?? null,
                    'link'         => $GalleryItems['item_link'][$index] ?? null,
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
        //$gallery =  Gallery::find($request->id)->galleryItems()->get();
        $gallery =  Gallery::with('galleryItems')->find($request->id);
        return response()->json($gallery);
    }


    public function update(Request $request)
    {


        try
        {
            $gallery = Gallery::find($request->gallery_id);
            if ($request->hasFile('thumbnail')) {

                $originalName = $request->thumbnail->getClientOriginalName();
                $thumbnail = $request->thumbnail->storeAs('uploads/gallery', $originalName, 'public');


                $gallery->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'thumbnail' => $thumbnail,
                ]);
            }
            else
            {
                $gallery->update([
                    'title' => $request->title,
                    'description' => $request->description
                ]);
            }



         /*   $items = collect(request()->all())->filter(function ($value, $key) {
                return str_starts_with($key, 'item_');
            });*/

            $items = collect(request()->all())->filter(function ($value, $key) {
                return preg_match('/^item_\d+$/', $key);
            });

            Log::info(print_r($items->toArray(), true));

            foreach ($items as $item)
            {


               if( isset($item['src']))
                {
                    $originalName = $item['src']->getClientOriginalName();
                    $src = $item['src']->storeAs('uploads/gallery', $originalName, 'public');

                    $gallery->galleryItems()->where('id',$item['id'])->update(
                        [
                            'title' => $originalName,
                            'alt' => $item['alt'],
                            'link' => $item['link'],
                            'src' => $src,
                        ]
                    );

                }
               else
               {

                   $gallery->galleryItems()->where('id',$item['id'])->update(
                       [
                           'alt' => $item['alt'],
                           'link' => $item['link'],
                       ]
                   );
               }

            }



            $GalleryItems = request()->only(['item_alt', 'items_src', 'item_link']);

            $new_items = [];

            foreach ($GalleryItems['items_src'] as $index => $imgSrc) {

                $originalName = $imgSrc->getClientOriginalName();
                $src = $imgSrc->storeAs('uploads/gallery', $originalName, 'public');

                $new_items[] = [
                    'title'        => $originalName,
                    'description'  => '',
                    'gallery_id'   => $gallery->id,
                    'src'          => $src,
                    'alt'          => $GalleryItems['item_alt'][$index] ?? null,
                    'link'         => $GalleryItems['item_link'][$index] ?? null,
                    'status'       => 1
                ];
            }


            $gallery->galleryItems()->createMany($new_items);





            return redirect()->back()->with('success', 'Gallery updated successfully');





        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

}
