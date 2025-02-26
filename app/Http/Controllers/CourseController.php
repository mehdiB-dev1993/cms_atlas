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
        return view('course.list')->with('courses', $courses);
    }

    public function create()
    {
        $course_groups = CourseGroup::where('parent_id', 0)->with('childrenRecursive')->get();
        $galleries = Gallery::all();
        return view('course.create')->with('course_groups', $course_groups)->with('galleries', $galleries);
    }
    public function store(CourseStoreRequest $request)
    {
        $request->validated();

        try
        {
            $course = new Course();
            $course->gallery_id = $request->gallery_id;
            $course->title = $request->title;
            $course->text = $request->text;
            $course->full_text = $request->full_text;
            $course->description = $request->description;
            $course->keywords = $request->keywords;
            $course->source = $request->source;
            $course->order = 0;
            $course->status = $request->has('status') ? 1 : 0;
            $course->date = $request->date;
            $course->price = $request->price;
            $course->duration = $request->duration;
            $course->teacher = $request->teacher;
            $course->link = $request->link;

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

            return redirect()->back()->with('success','create success');
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
        return view('course.edit')->with('course_groups', $course_groups)->with('galleries', $galleries)->with('this_course', $this_course);

    }




    public function update(Request $request)
    {


        try
        {

            $course = Course::find($request->course_id);

            $course->gallery_id =  $request->gallery_id ;
            $course->title = $request->title;
            $course->text = $request->text;
            $course->full_text = $request->full_text;
            $course->description = $request->description;
            $course->keywords = $request->keywords;
            $course->source = $request->source;
            $course->order = 0;
            $course->status = $request->has('status') ? 1 : 0;
            $course->date = $request->date;
            $course->price = $request->price;
            $course->duration = $request->duration;
            $course->teacher = $request->teacher;
            $course->link = $request->link;

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
