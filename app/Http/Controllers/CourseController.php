<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseExam;
use App\Models\CourseMaterial;
use App\Models\CourseStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ID role admin
        $adminRoleId = 1;

        $studentRoleId = 3;
        
        // Cek apakah pengguna adalah admin
        $isAdmin = Auth::user()->user_role_id === $adminRoleId;

        $isStudent = Auth::user()->user_role_id === $studentRoleId;
        
        // Base query
        $coursesQuery = Course::join('course_categories', 'courses.course_category_id', '=', 'course_categories.id')
            ->join('users', 'courses.instructor_id', '=', 'users.id')
            ->select('courses.*', 'course_categories.course_category_name as category_name', 'users.name as instructor_name');

        $courseStudentQuery = CourseStudent::join('courses', 'course_students.course_id', '=', 'courses.id')
            ->join('users', 'course_students.user_id', '=', 'users.id')
            ->join('course_categories', 'courses.course_category_id', '=', 'course_categories.id')
            ->select('course_students.*', 'courses.*', 'course_categories.course_category_name as category_name', 'users.name as instructor_name');
        
        // filter untuk pengguna non-admin
        if (!$isAdmin) {
            if (!$isStudent) {
                $courses = $coursesQuery->where('courses.instructor_id', Auth::id())->get();
                
                $category = CourseCategory::all();
        
                return view('pages.course.index', compact('courses', 'category'));
            } else {
                $courses = $courseStudentQuery->where('course_students.user_id', Auth::id())->get();
                
                $category = CourseCategory::all();
        
                // dd($courses);
                
                return view('pages.course.index', compact('courses', 'category'));
            }
        } else {
            $courses = $coursesQuery->get();
        
            $category = CourseCategory::all();
        
            return view('pages.course.index', compact('courses', 'category'));
        }
        
        // Ambil data
        
    }

    public function getModuleCount(Request $request) {
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $moduleCount = CourseMaterial::where('course_id', $query)->count();
        $examCount = CourseExam::where('course_id', $query)->count();
        return response()->json([
            'moduleCount' => $moduleCount,
            'examCount' => $examCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getOneData(Request $request)
    {
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $course = Course::where('id', $query)->first();
        return response()->json($course);
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

            $instructorID = Auth::user()->id;
            
            Course::create([
                'course_name' => $validated['course_name'],
                'course_category_id' => $validated['course_category_id'],
                'course_image' => $validated['course_image'],
                'course_price' => $validated['course_price'],
                'course_benefit' => $validated['course_benefit'],
                'is_discount' => $validated['is_discount'],
                'discount_percentage' => $validated['discount_percentage'] ?? 0,
                'course_description' => $validated['course_description'],
                'instructor_id' => $instructorID,
            ]);
        });

        return redirect()->route('admin.courses.index');
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
    public function update(CourseUpdateRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        
        DB::transaction(function () use ($request, $course) {
            $validated = $request->validated();
            
            // If there's a new image, store it and delete the old one
            if ($request->hasFile('course_image')) {
                // Delete the old image if it exists
                if ($course->course_image && Storage::disk('public')->exists($course->course_image)) {
                    Storage::disk('public')->delete($course->course_image);
                }
                
                // Store the new image
                $validated['course_image'] = $request->file('course_image')->store('images', 'public');
            }
            
            $course->update([
                'course_name' => $validated['course_name'],
                'course_category_id' => $validated['course_category_id'],
                'course_price' => $validated['course_price'],
                'course_benefit' => $validated['course_benefit'],
                'is_discount' => $validated['is_discount'],
                'discount_percentage' => $validated['discount_percentage'],
                'course_description' => $validated['course_description'],
                'course_image' => $validated['course_image'] ?? $course->course_image,
            ]);
        });
        
        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        DB::transaction(function () use ($course) {
            // Delete the course image if it exists
            if ($course->course_image && Storage::disk('public')->exists($course->course_image)) {
                Storage::disk('public')->delete($course->course_image);
            }
            
            $course->delete();
        });

        return redirect()->route('admin.courses.index');
    }
}
