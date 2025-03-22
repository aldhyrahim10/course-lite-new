<?php

namespace App\Http\Controllers;

use App\Models\CourseExam;
use Illuminate\Http\Request;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $courseName = Course::findOrFail($id);
        $courseExams = CourseExam::with('course')->where('course_id', $id)->get();

        return view("pages.exam.index", compact('courseExams', 'courseName'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($idExam)
    {
        $courseExams = CourseExam::with('course')->where('course_id', $idExam)->get();

        return view("pages.exam.detail", compact('courseExams'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseExam $courseExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseExam $courseExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseExam $courseExam)
    {
        //
    }
}
