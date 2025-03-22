<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseMaterialStoreRequest;
use App\Http\Requests\CourseMaterialUpdateRequest;
use App\Models\Course;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $courseName = Course::findOrFail($id);
        $courseModuls = CourseMaterial::with('course')->where('course_id', $id)->get();

        return view('pages.materials.index', compact('courseModuls', 'courseName'));
    }

    public function getOneData(Request $request)
    {
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $courseMaterial = CourseMaterial::where('id', $query)->first();

        return response()->json($courseMaterial);
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
    public function store(CourseMaterialStoreRequest $request)
    {
        DB::transaction(function() use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('course_material_modul')) {
                $validated['course_material_modul'] = $request->file('course_material_modul')->store('materials', 'public');
            }

            if ($request->hasFile('course_material_video')) {
                $validated['course_material_video'] = $request->file('course_material_video')->store('videos', 'public');
            }

            CourseMaterial::create($validated);
        });

        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseMaterial $courseMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseMaterial $courseMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseMaterialUpdateRequest $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            $courseMaterial = CourseMaterial::findOrFail($id);
            $validated = $request->validated();

            if ($request->hasFile('course_material_modul')) {
                if ($courseMaterial->course_material_modul && Storage::disk('public')->exists($courseMaterial->course_material_modul)) {
                    Storage::disk('public')->delete($courseMaterial->course_material_modul);
                }

                $validated['course_material_modul'] = $request->file('course_material_modul')->store('materials', 'public');
            }

            if ($request->hasFile('course_material_video')) {
                if ($courseMaterial->course_material_video && Storage::disk('public')->exists($courseMaterial->course_material_video)) {
                    Storage::disk('public')->delete($courseMaterial->course_material_video);
                }

                $validated['course_material_video'] = $request->file('course_material_video')->store('videos', 'public');
            }

            $courseMaterial->update($validated);
        });

        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $courseMaterial = CourseMaterial::findOrFail($id);

        DB::transaction(function() use ($id, $courseMaterial) {
            if ($courseMaterial->course_material_modul && Storage::disk('public')->exists($courseMaterial->course_material_modul)) {
                Storage::disk('public')->delete($courseMaterial->course_material_modul);
            }

            if ($courseMaterial->course_material_video && Storage::disk('public')->exists($courseMaterial->course_material_video)) {
                Storage::disk('public')->delete($courseMaterial->course_material_video);
            }

            $courseMaterial->delete();
        });

        return redirect()->route('admin.courses.index');
    }
}
