<?php

namespace App\Http\Controllers;

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
        return view('course_group.list')->with('course_groups', $course_groups);
    }

    public function create()
    {
        $course_groups = CourseGroup::where('parent_id', 0)->with('childrenRecursive')->get();
        return view('course_group.create')->with('course_groups', $course_groups);
    }

    public function store(CourseStoreRequest $request)
    {
        $request->validated();
        try {
           $courseGroup = new CourseGroup();
           $courseGroup->title = $request->input('title');
           $courseGroup->description = $request->input('description');
           $courseGroup->status = $request->has('status') ? 1 : 0;
           $courseGroup->parent_id = $request->input('parent_id');

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
            }
            $courseGroup->thumbnail = $thumbnail;
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
        return view('course_group.edit')->with('course_groups', $course_groups)->with('this_course_groups', $this_course_groups);
    }



    public function update(Request $request)
    {
        try {


            $cg = CourseGroup::find($request->cg_id);
            $cg->title = $request->title;
            $cg->description = $request->description;
            $cg->status = $request->has('status') ? 1 : 0;


            if ($request->hasFile('thumbnail'))
            {
                $path_thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $cg->thumbnail = $path_thumbnail;
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
