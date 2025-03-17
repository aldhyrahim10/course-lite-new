<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index() {
        return view('pages.auth.register');
    }

    public function register(RegisterRequest $request) {
        $validated = $request->validated();

        if ($request->hasFile('user_image')) {
            $imagePath = $request->file('user_image')->store('images', 'public');
            $validated['user_image'] = $imagePath;
        }

        $defaultRole = UserRole::where('user_role_name', 'student')->first();

        $user = User::create([
            'user_role_id' => $defaultRole->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'no_telp' => $validated['no_telp'],
            'user_image' => $validated['user_image']
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Register success');
    }
}
