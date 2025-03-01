<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageStoreRequest;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('menu')->get();
        return view('admin.page.list')->with('pages',$pages);
    }

    public function create()
    {
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        $galleries = Gallery::all();
        return view('admin.page.create')->with('menus', $menus)->with('galleries', $galleries);
    }

    public function store(PageStoreRequest $request)
    {
       $request->validated();
        try
        {
            $page = new Page();
            $page->gallery_id = $request->gallery_id;
            $page->menu_id = $request->menu_id;
            $page->title = $request->title;
            $page->name = $request->name;
            $page->description = $request->description;
            $page->abstract = $request->abstract;
            $page->text = $request->text;
            $page->keywords = $request->keywords;
            $page->source_link = $request->source_link;
            $page->status = $request->has('status') ? 1 : 0;
            $page->order = $request->order;
            $page->published_at = $request->published_at;

            if ($request->hasFile('icon'))
            {
                $path_icon = $request->file('icon')->store('uploads/icons', 'public');
                $page->icon = $path_icon;
            }


            if ($request->hasFile('thumbnail'))
            {
                $path_thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $page->thumbnail = $path_thumbnail;
            }


            if ($request->hasFile('header_image'))
            {
                $path_header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $page->header_image = $path_header_image;
            }

            if ($request->hasFile('attached_file'))
            {
                $path_attached_file = $request->file('attached_file')->store('uploads/attached_file', 'public');
                $page->attached_file = $path_attached_file;
            }

            $page->save();


            return redirect()->back()->with('success','page created successfully');

        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        $galleries = Gallery::all();
        $page = Page::find($request->id);
        return view('admin.page.edit')->with('menus', $menus)->with('galleries', $galleries)->with('page', $page);
    }

    public function update(Request $request)
    {

        try {


            $page = Page::find($request->page_id);
            $page->gallery_id = $request->gallery_id;
            $page->menu_id = $request->menu_id;
            $page->title = $request->title;
            $page->name = $request->name;
            $page->abstract = $request->abstract;
            $page->text = $request->text;
            $page->description = $request->description;
            $page->keywords = $request->keywords;
            $page->source_link = $request->source_link;
            $page->status = $request->has('status') ? 1 : 0;
            $page->order = $request->order;
            $page->published_at = $request->published_at;

            if ($request->hasFile('icon'))
            {
                $path_icon = $request->file('icon')->store('uploads/icons', 'public');
                $page->icon = $path_icon;
            }


            if ($request->hasFile('thumbnail'))
            {
                $path_thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $page->thumbnail = $path_thumbnail;
            }


            if ($request->hasFile('header_image'))
            {
                $path_header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $page->header_image = $path_header_image;
            }

            $page->save();
            return redirect()->back()->with('success','page updated successfully');


        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function destroy(Request $request)
    {

        try {
            $page = Page::find($request->id);
            if ($page)
            {
                $page->delete();
                return redirect()->back()->with('success','عملیات با موفقیت انجام شد!');
            }

        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }



    public function show(Request $request)
    {
        dd($request->id);
    }


}
