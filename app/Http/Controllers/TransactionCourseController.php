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
        // ID role admin
        $adminRoleId = 1;

        $studentRoleId = 3;
        
        // Cek apakah pengguna adalah admin
        $isAdmin = Auth::user()->user_role_id === $adminRoleId;

        $isStudent = Auth::user()->user_role_id === $studentRoleId;
        
        // Base query
        $transactionQuery = TransactionCourse::join('courses', 'transaction_courses.course_id', '=', 'courses.id')
            ->join('users', 'transaction_courses.user_id', '=', 'users.id')
            ->select('transaction_courses.*', 'courses.course_name as course_name', 'users.name as user_name');

        if ($isStudent) {
            $transactions = $transactionQuery->where('transaction_courses.user_id', Auth::id())->get();

            return view('pages.transaction.index', compact('transactions'));
        }

        $transactions = $transactionQuery->get();

        return view('pages.transaction.index', compact('transactions'));
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
        $validated['status'] = 1;

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
