<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseExamStoreRequest;
use App\Http\Requests\CourseExamUpdateRequest;
use App\Models\Course;
use App\Models\CourseExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getOneData(Request $request)
    {
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $courseExam = CourseExam::where('id', $query)->first();

        return response()->json($courseExam);
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
    public function store(CourseExamStoreRequest $request)
    {
        DB::transaction(function() use ($request) {
            $validated = $request->validated();

            $validated['course_total_question'] = 0;

            CourseExam::create($validated);
        });

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseExam $courseExam)
    {
        //
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
    public function update(CourseExamUpdateRequest $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            $validated = $request->validated();

            $courseExam = CourseExam::findOrFail($id);
            $courseExam->update($validated);
        });

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::transaction(function() use ($id) {
            $courseExam = CourseExam::findOrFail($id);
            $courseExam->delete();
        });

        return redirect()->back();
    }
}
