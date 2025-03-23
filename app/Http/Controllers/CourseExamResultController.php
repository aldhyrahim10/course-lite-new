<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseExamResult;
use App\Models\CourseStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // ID role admin

        $instructorRoleId = 2;

        $studentRoleId = 3;
        
        // Cek apakah pengguna adalah admin

        $isInstructor = Auth::user()->user_role_id === $instructorRoleId;

        $isStudent = Auth::user()->user_role_id === $studentRoleId;
        
        // Base query
        $courseStudentQuery = CourseExamResult::join('courses', 'course_exam_results.course_id', '=', 'courses.id')
            ->join('users', 'course_exam_results.student_user_id', '=', 'users.id')
            ->select(
                'course_exam_results.*', 
                'courses.*', 
                'users.name as user_name'
            );

        if ($isInstructor) {
            $query = $courseStudentQuery->where('courses.instructor_id', Auth::user()->id);
        } elseif ($isStudent) {
            $query = $courseStudentQuery->where('course_exam_results.student_user_id', Auth::user()->id);
        }

        $results = $query->get();

        return view('pages.exam.result', compact('results'));
    }

    public function indexAdmin() {
        $courses = Course::get();

        return view('pages.exam.result-admin', compact('courses'));
    }
    
    public function resultAdmin($id) {
        $results = CourseExamResult::join('courses', 'course_exam_results.course_id', '=', 'courses.id')
            ->join('users', 'course_exam_results.student_user_id', '=', 'users.id')
            ->where('course_id', $id)
            ->select(
                'course_exam_results.*', 
                'courses.*', 
                'users.name as user_name'
            )->get();

        return view('pages.exam.result', compact('results'));
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
