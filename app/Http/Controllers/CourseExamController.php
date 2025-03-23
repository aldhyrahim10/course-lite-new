<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseExamStoreRequest;
use App\Http\Requests\CourseExamUpdateRequest;
use App\Models\Course;
use App\Models\CourseExam;
use App\Models\CourseExamQuestion;
use Illuminate\Http\Request;
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

            CourseExam::create($validated);
        });

        return redirect()->back();
    }

    public function storeQuestion(Request $request)
    {
        $validated = $request->validate([
            'answers.*.course_exam_answer_description' => 'required|string',
            'answers.*.is_true' => 'required|boolean',
            'course_exam_question_description' => 'required|string',
            'course_exam_id' => 'required|integer|exists:course_exams,id',
        ]);

        $courseExamQuestion = CourseExamQuestion::create([
            'course_exam_id' => $validated['course_exam_id'],
            'course_exam_question_description' => $validated['course_exam_question_description'],
        ]);

        foreach ($validated['answers'] as $answer) {
            $courseExamQuestion->answers()->create([
                'course_exam_question_id' => $courseExamQuestion->id,
                'course_exam_answer_description' => $answer['course_exam_answer_description'],
                'is_true' => $answer['is_true'],
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $idExam)
    {
        $courseExam = CourseExam::where('id', $idExam)->first();

        $courseAnswers = CourseExamQuestion::where('course_exam_id', $idExam)
            ->with('answers')  // Assuming you have the relationship set up
            ->get();

        return view("pages.exam.detail", compact('courseExam', 'courseAnswers'));
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

    public function destroyQuestion($id)
    {
        DB::transaction(function() use ($id) {
            $courseExamQuestion = CourseExamQuestion::findOrFail($id);
        
            // Delete associated answers first
            $courseExamQuestion->answers()->delete();
            
            // Then delete the question
            $courseExamQuestion->delete();
        });

        return redirect()->back();
    }
}

