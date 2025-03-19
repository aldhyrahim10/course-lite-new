<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserListStoreRequest;
use App\Http\Requests\UserListUpdateRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserListController extends Controller
{
    public function index() {
        $users = User::join('user_roles', 'users.user_role_id', '=', 'user_roles.id')
            ->select('users.*', 'user_roles.user_role_name as role_name')
            ->get();
        $roles = UserRole::all();

        return view('pages.user-list.index', compact('users', 'roles'));
    }

    public function getOneData(Request $request)
    {
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $course = User::where('id', $query)->first();
        return response()->json($course);
    }

    public function store(UserListStoreRequest $request) {
        DB::transaction(function() use ($request) {
            $data = $request->validated();

            if ($request->hasFile('user_image')) {
                $data['user_image'] = $request->file('user_image')->store('user-images', 'public');
            }

            $data['password'] = bcrypt($data['password']);

            $instructorID = UserRole::where('user_role_name', 'instructor')->first()->id;

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'no_telp' => $data['no_telp'],
                'user_role_id' => $instructorID,
                'user_image' => $data['user_image'],
            ]);
        });

        return redirect()->route('admin.user-list.index');
    }

    public function update(UserListUpdateRequest $request, $id) {
        DB::transaction(function() use ($request, $id) {
            $data = $request->validated();

            $user = User::findOrFail($id);

            if ($request->hasFile('user_image')) {
                if ($user->user_image && Storage::disk('public')->exists($user->user_image)) {
                    Storage::disk('public')->delete($user->user_image);
                }

                $data['user_image'] = $request->file('user_image')->store('user-images', 'public');
            }

             if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);
        });

        return redirect()->route('admin.user-list.index');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        if ($user->user_image && Storage::disk('public')->exists($user->user_image)) {
            Storage::disk('public')->delete($user->user_image);
        }

        $user->delete();

        return redirect()->route('admin.user-list.index');
    }
}
