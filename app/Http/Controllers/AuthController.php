<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'id_number' => 'required|string',
            'password'  => 'required|string',
            'role'      => 'required|string|in:Admin,Teacher,Student',
        ]);

        // Step 1: Find user by ID number
        $user = User::where('id_number', $request->id_number)->first();

        if (!$user) {
            return back()->withErrors(['id_number' => 'Invalid ID number or password.'])->onlyInput('id_number');
        }

        // Step 2: Check password (hashed)
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['id_number' => 'Invalid ID number or password.'])->onlyInput('id_number');
        }

        // Step 3: Check role (case-insensitive)
        if (strcasecmp($user->role, $request->role) !== 0) {
            return back()->withErrors(['role' => 'Selected role does not match this account.'])->onlyInput('id_number');
        }

        // Step 4: Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Step 5: Redirect based on role
        return match (ucfirst(strtolower($user->role))) {
            'Admin' => redirect()->route('admin.dashboard'),
            'Teacher' => redirect()->route('teacher.dashboard'),
            'Student' => redirect()->route('student.dashboard'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
