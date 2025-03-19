<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleStoreRequest;
use App\Http\Requests\UserRoleUpdateRequest;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRoles = UserRole::all();

        return view('pages.user-role.index', compact('userRoles'));
    }

    public function getOneData(Request $request)
    {
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $course = UserRole::where('id', $query)->first();
        return response()->json($course);
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
    public function store(UserRoleStoreRequest $request)
    {
        DB::transaction(function() use ($request) {
            $data = $request->validated();

            UserRole::create($data);
        });

        return redirect()->route('admin.user-role.index');
     }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRole $userRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRoleUpdateRequest $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            $data = $request->validated();

            $userRole = UserRole::findOrFail($id);
            $userRole->update($data);
        });

        return redirect()->route('admin.user-role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userRole = UserRole::findOrFail($id);
        $userRole->delete();

        return redirect()->route('admin.user-role.index');
    }
}
