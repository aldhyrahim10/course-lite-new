<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseCategoryStoreRequest;
use App\Http\Requests\CourseCategoryUpdateRequest;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseCategories = CourseCategory::all();
        return view('pages.course-category.index', compact('courseCategories'));
    }

    public function getOneData(Request $request){
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $category = CourseCategory::where('id', $query)->first();
        return response()->json($category);
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
    public function store(CourseCategoryStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            CourseCategory::create($request->validated());
        });

        return redirect()->route('admin.course-categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseCategory $courseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $courseCategory = CourseCategory::findOrFail($id);
        return response()->json([
            'id' => $courseCategory->id,
            'course_category_name' => $courseCategory->course_category_name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $courseCategory = CourseCategory::findOrFail($id);

            $courseCategory->update($request->validated());
        });

        return redirect()->route('admin.course-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            CourseCategory::findOrFail($id)->delete();
        });

        return redirect()->route('admin.course-categories.index');
    }
}
