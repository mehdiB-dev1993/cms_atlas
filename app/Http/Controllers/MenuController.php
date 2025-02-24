<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuStoreRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function index()
    {
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('admin.menu.menu')->with('menus', $menus);
    }

    public function create()
    {
        $menus = Menu::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('admin.menu.menu-create')->with('menus', $menus);
    }

    public function store(MenuStoreRequest $request)
    {

        $request->validated();

        try
        {


            if ($request->hasFile('icon'))
            {
                $path_icon = $request->file('icon')->store('uploads/icons', 'public');
            }

            if ($request->hasFile('thumbnail'))
            {
                $path_thumb = $request->file('thumbnail')->store('uploads/thumb', 'public');
            }

            if ($request->hasFile('header_image'))
            {
                $path_header_image = $request->file('header_image')->store('uploads/header_image', 'public');
            }


            $menu = new Menu();
            $menu->parent_id = $request->parent_id;
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->text	= $request->text;
            $menu->full_text = $request->full_text;
            $menu->keywords = $request->keywords;
            $menu->thumbnail = $path_thumb ?? NULL;
            $menu->icon = $path_icon ?? NULL;
            $menu->header_image = $path_header_image ?? NULL;
            $menu->order = 0;
            $menu->status = 0;
            $menu->save();


            return redirect()->back()->with('success', 'عملیات با موفقیت انجام شد.');

        }
        catch
        (\Exception $e)
        {
            return  redirect()->back()->with('error', $e->getMessage());
        }

    }

}
