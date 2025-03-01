<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\CourseGroup;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('courseGroups')->get();
        return view('admin.course.list')->with('courses', $courses);
    }

    public function create()
    {
        $course_groups = CourseGroup::where('parent_id', 0)->with('childrenRecursive')->get();
        $galleries = Gallery::all();
        return view('admin.course.create')->with('course_groups', $course_groups)->with('galleries', $galleries);
    }
    public function store(CourseStoreRequest $request)
    {
        $request->validated();


        try
        {
            $course = new Course();
            $course->gallery_id = $request->gallery_id;
            $course->name = $request->name;
            $course->title = $request->title;
            $course->abstract = $request->abstract;
            $course->text = $request->text;
            $course->description = $request->description;
            $course->keywords = $request->keywords;
            $course->source_link = $request->source_link;
            $course->order = $request->order;
            $course->status = $request->has('status') ? 1 : 0;
            $course->start_date = $request->start_date;
            $course->price = $request->price;
            $course->discount = $request->discount;
            $course->duration = $request->duration;
            $course->teacher = $request->teacher;
            $course->link = $request->link;
            $course->published_at = $request->published_at;

            if ($request->hasFile('icon')) {
                $path_icon = $request->file('icon')->store('uploads/icon', 'public');
                $course->icon = $path_icon;
            }
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $course->thumbnail = $thumbnail;
            }
            if ($request->hasFile('header_image')) {
                $path_header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $course->header_image = $path_header_image;
            }
            if ($request->hasFile('attached_file')) {
                $attached_file = $request->file('attached_file')->store('uploads/attached_file', 'public');
                $course->attached_file = $attached_file;
            }
            $course->save();

            $course->courseGroups()->attach($request->cg_id,['created_at' => now(), 'updated_at' => now()]);

            return redirect()->back()->with('success','عملیات دخیره دوره با موفقیت انجام شد.');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function show($id)
    {
        try {

            $course = Course::with('courseGroups')->find($id);
            return response()->json($course);

        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }

    }
    public function edit(Request $request)
    {
        $course_groups = CourseGroup::where('parent_id', 0)->with('childrenRecursive')->get();
        $this_course = Course::find($request->id);
        $galleries = Gallery::all();
        return view('admin.course.edit')->with('course_groups', $course_groups)->with('galleries', $galleries)->with('this_course', $this_course);

    }




    public function update(Request $request)
    {


        try
        {

            $course = Course::find($request->course_id);

            $course->gallery_id = $request->gallery_id;
            $course->name = $request->name;
            $course->title = $request->title;
            $course->abstract = $request->abstract;
            $course->text = $request->text;
            $course->description = $request->description;
            $course->keywords = $request->keywords;
            $course->source_link = $request->source_link;
            $course->order = $request->order;
            $course->status = $request->has('status') ? 1 : 0;
            $course->start_date = $request->start_date;
            $course->price = $request->price;
            $course->discount = $request->discount;
            $course->duration = $request->duration;
            $course->teacher = $request->teacher;
            $course->link = $request->link;
            $course->published_at = $request->published_at;

            if ($request->hasFile('icon')) {
                $path_icon = $request->file('icon')->store('uploads/icon', 'public');
                $course->icon = $path_icon;
            }
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
                $course->thumbnail = $thumbnail;
            }
            if ($request->hasFile('header_image')) {
                $path_header_image = $request->file('header_image')->store('uploads/header_image', 'public');
                $course->header_image = $path_header_image;
            }
            $course->save();

            $course->courseGroups()->attach($request->cg_id,['created_at' => now(), 'updated_at' => now()]);

            return redirect()->back()->with('success','update success');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
