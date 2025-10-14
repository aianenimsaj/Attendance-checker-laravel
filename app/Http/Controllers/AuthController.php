<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'id_number' => 'required|string',
            'password'  => 'required|string|min:6',
            'role'      => 'required|string|in:Admin,Teacher,Student',
        ]);

        // Find the user by ID number
        $user = User::where('id_number', $request->id_number)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            
            // Check if selected role matches user's role
            if ($user->role !== $request->role) {
                return back()->withErrors([
                    'role' => 'Selected role does not match this account.'
                ])->onlyInput('id_number');
            }

            // Login the user
            Auth::login($user);
            $request->session()->regenerate();
            $request->session()->put('selected_role', $user->role);

            // Redirect based on role
            return match ($user->role) {
                'Admin'   => redirect()->route('admin.dashboard'),
                'Teacher' => redirect()->route('teacher.dashboard'),
                'Student' => redirect()->route('student.dashboard'),
            };
        }

        // If login fails
        return back()->withErrors([
            'id_number' => 'Invalid ID number or password.',
        ])->onlyInput('id_number');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
