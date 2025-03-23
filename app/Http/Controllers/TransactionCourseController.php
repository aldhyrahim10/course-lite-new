<?php

namespace App\Http\Controllers;

use App\Models\TransactionCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionCourseController extends Controller
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
            'user_id' => 'nullable',
            'course_id' => 'required|integer|exists:courses,id',
            'total_payment' => 'required|integer',
            'status' => 'nullable',
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['status'] = 0;

        TransactionCourse::create($validated);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionCourse $transactionCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionCourse $transactionCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionCourse $transactionCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionCourse $transactionCourse)
    {
        //
    }
}
