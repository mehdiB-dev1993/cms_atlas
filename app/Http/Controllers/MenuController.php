<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuStoreRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('menu.list')->with('menus', $menus);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('menu.create')->with('menus', $menus);
    }

    public function store(MenuStoreRequest $request): \Illuminate\Http\RedirectResponse
    {

        $request->validated();

        try
        {
            $menu = new Menu();

            $menu->parent_id = $request->parent_id;
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->text	= $request->text;
            $menu->full_text = $request->full_text;
            $menu->keywords = $request->keywords;
            $menu->order = $request->order;
            $menu->status = $request->has('status')?1:0;


            if ($request->hasFile('icon'))
            {
                $path_icon = $request->file('icon')->store('uploads/icons', 'public');
                $menu->icon = $path_icon;
            }

            if ($request->hasFile('thumbnail'))
            {
                $path_thumb = $request->file('thumbnail')->store('uploads/thumb', 'public');
                $menu->thumbnail = $path_thumb ;
            }

            if ($request->hasFile('header_image'))
            {
                $path_header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $menu->header_image = $path_header_image ;
            }



            $menu->save();


            return redirect()->back()->with('success', 'عملیات با موفقیت انجام شد.');

        }
        catch
        (\Exception $e)
        {
            return  redirect()->back()->with('error', $e->getMessage());
        }

    }


    public function edit(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        $menu = Menu::find($request->id);
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('menu.edit')->with('this_menu', $menu)->with('menus', $menus);
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        try
        {
            $menu = Menu::find($request->menu_id);

            $menu->parent_id = intval( $request->parent_id );
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->text	= $request->text;
            $menu->full_text = $request->full_text;
            $menu->keywords = $request->keywords;
            $menu->order = $request->order;
            $menu->status = $request->has('status')?1:0;

            if ($request->hasFile('icon'))
            {
                $path_icon = $request->file('icon')->store('uploads/icons', 'public');
                $menu->icon = $path_icon;
            }

            if ($request->hasFile('thumbnail'))
            {
                $path_thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $menu->thumbnail = $path_thumbnail;
            }

            if ($request->hasFile('header_image'))
            {
                $path_header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $menu->header_image = $path_header_image;
            }

            $menu->save();

            return redirect()->back()->with('success', 'عملیات با موفقیت انجام شد.');

        }
        catch (\Exception $e)
        {
            return  redirect()->back()->with('error', $e->getMessage());
        }
    }
}
