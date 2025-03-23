<?php

namespace App\Http\Controllers;

use App\Models\CourseExamResult;
use Illuminate\Http\Request;

class CourseExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'student_user_id' => 'required|integer|exists:users,id',
            'course_exam_point' => 'required|integer',
            'is_passed' => 'required',
        ]);

        CourseExamResult::create($validated);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseExamResult $courseExamResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseExamResult $courseExamResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseExamResult $courseExamResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseExamResult $courseExamResult)
    {
        //
    }
}
