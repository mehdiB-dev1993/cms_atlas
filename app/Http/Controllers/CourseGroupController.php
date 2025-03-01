<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseGroupStoreRequest;
use App\Http\Requests\CourseStoreRequest;
use App\Models\CourseGroup;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class CourseGroupController extends Controller
{
    public function index()
    {
        $course_groups = CourseGroup::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('admin.course_group.list')->with('course_groups', $course_groups);
    }

    public function create()
    {
        $course_groups = CourseGroup::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('admin.course_group.create')->with('course_groups', $course_groups);
    }

    public function store(CourseGroupStoreRequest $request)
    {
        $request->validated();
        try {
           $courseGroup = new CourseGroup();
           $courseGroup->name = $request->input('name');
           $courseGroup->title = $request->input('title');
           $courseGroup->description = $request->input('description');
           $courseGroup->abstract = $request->input('abstract');
           $courseGroup->text = $request->input('text');
           $courseGroup->keywords = $request->input('keywords');
           $courseGroup->status = $request->has('status') ? 1 : 0;
           $courseGroup->parent_id = $request->input('parent_id');
           $courseGroup->order = $request->input('order');

            if ($request->hasFile('icon')) {
                $icon = $request->file('icon')->store('uploads/icon', 'public');
                $courseGroup->icon = $icon;
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $courseGroup->thumbnail = $thumbnail;
            }

            if ($request->hasFile('header_image')) {
                $header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $courseGroup->header_image = $header_image;
            }

            $courseGroup->save();
            return redirect()->back()->with('success','create success');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $course_groups = CourseGroup::where('parent_id', 0)->with('childrenRecursive')->get();
        $this_course_groups = CourseGroup::find($request->id);
        return view('admin.course_group.edit')->with('course_groups', $course_groups)->with('this_course_groups', $this_course_groups);
    }



    public function update(Request $request)
    {
        try {


            $cg = CourseGroup::find($request->cg_id);
            $cg->name = $request->input('name');
            $cg->title = $request->input('title');
            $cg->description = $request->input('description');
            $cg->abstract = $request->input('abstract');
            $cg->text = $request->input('text');
            $cg->keywords = $request->input('keywords');
            $cg->status = $request->has('status') ? 1 : 0;
            $cg->parent_id = $request->input('parent_id');
            $cg->order = $request->input('order');

            if ($request->hasFile('icon')) {
                $icon = $request->file('icon')->store('uploads/icon', 'public');
                $cg->icon = $icon;
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $cg->thumbnail = $thumbnail;
            }

            if ($request->hasFile('header_image')) {
                $header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $cg->header_image = $header_image;
            }

            $cg->save();
            return redirect()->back()->with('success','CourseGroup updated successfully');


        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function destroy(Request $request)
    {

        try {
            $cg = CourseGroup::find($request->id);
            if ($cg)
            {
                $cg->delete();
                return redirect()->back()->with('success','عملیات با موفقیت انجام شد!');
            }

        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

}
