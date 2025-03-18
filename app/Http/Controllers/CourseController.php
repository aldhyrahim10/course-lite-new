<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = DB::table('courses')->join('course_categories', 'courses.course_category_id', '=', 'course_categories.id')->select('courses.*', 'course_categories.course_category_name as category_name')->get();
        $category = CourseCategory::all();
        return view('pages.course.index', compact('courses', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('course_image')) {
                $validated['course_image'] = $request->file('course_image')->store('images', 'public');
            }
            
            Course::create($validated);
        });

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {
        DB::transaction(function () use ($request, $course) {
            $validated = $request->validated();

            if ($request->hasFile('course_image')) {
                $validated['course_image'] = $request->file('course_image')->store('images', 'public');
            }

            $course->update($validated);
        });

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        DB::transaction(function () use ($course) {
            $course->delete();
        });

        return redirect()->route('courses.index');
    }
}
