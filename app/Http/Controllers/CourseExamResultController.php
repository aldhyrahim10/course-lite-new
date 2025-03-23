<?php

namespace App\Http\Controllers;

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
        $adminRoleId = 1;

        $instructorRoleId = 2;

        $studentRoleId = 3;
        
        // Cek apakah pengguna adalah admin
        $isAdmin = Auth::user()->user_role_id === $adminRoleId;

        $isInstructor = Auth::user()->user_role_id === $instructorRoleId;

        $isStudent = Auth::user()->user_role_id === $studentRoleId;
        
        // ID role admin
        $adminRoleId = 1;

        $instructorRoleId = 2;

        $studentRoleId = 3;
        
        // Cek apakah pengguna adalah admin
        $isAdmin = Auth::user()->user_role_id === $adminRoleId;

        $isInstructor = Auth::user()->user_role_id === $instructorRoleId;

        $isStudent = Auth::user()->user_role_id === $studentRoleId;
        
        // Base query
        $courseStudentQuery = CourseStudent::join('courses', 'course_students.course_id', '=', 'courses.id')
            ->join('users', 'course_students.user_id', '=', 'users.id')
            ->join('course_categories', 'courses.course_category_id', '=', 'course_categories.id')
            ->select(
                'course_students.*', 
                'courses.*', 
                'course_categories.course_category_name as category_name', 
                'users.name as user_name'
            );

        if ($isAdmin) {
            $query = $courseStudentQuery;
        } elseif ($isInstructor) {
            $query = $courseStudentQuery->where('courses.instructor_id', Auth::user()->id);
        } elseif ($isStudent) {
            $query = $courseStudentQuery->where('course_students.user_id', Auth::user()->id);
        }

        $results = $query->get();

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
            'course_id' => 'required|integer|exists:course,id',
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
