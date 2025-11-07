<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;


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

// Step 5: Regenerate session *after* login
        $request->session()->regenerate();

// Step 6: Redirect based on role safely
switch (ucfirst(strtolower($user->role))) {
    case 'Admin':
        return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
    case 'Teacher':
        return redirect()->route('teacher.dashboard')->with('success', 'Welcome, Teacher!');
    case 'Student':
        return redirect()->route('student.dashboard')->with('success', 'Welcome, Student!');
    default:
        Auth::logout();
        return redirect()->route('login')->withErrors(['role' => 'Invalid role.']);
}
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
