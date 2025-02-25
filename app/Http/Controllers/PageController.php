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
        return view('page.index')->with('pages',$pages);
    }

    public function create()
    {
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        $galleries = Gallery::all();
        return view('page.page-create')->with('menus', $menus)->with('galleries', $galleries);
    }

    public function store(PageStoreRequest $request)
    {
       $request->validated();
        try
        {
            $page = new Page();
            $page->gallery_id = $request->gallery_id;
            $page->title = $request->title;
            $page->title_in_menu = $request->title_in_menu;
            $page->text = $request->text;
            $page->full_text = $request->full_text;
            $page->description = $request->description;
            $page->keywords = $request->keywords;
            $page->source = $request->source;
            $page->order = 0;
            $page->status = $request->has('status') ? 1 : 0;
            $page->date = $request->date;

            if ($request->hasFile('page_icon'))
            {
                $path_icon = $request->file('page_icon')->store('uploads/icons', 'public');
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


            $menu = Menu::find($request->menu_id);
            $menu->update([
                'page_id'=> $page->id
            ]);


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
        return view('page.page-edit')->with('menus', $menus)->with('galleries', $galleries)->with('page', $page);
    }
}
