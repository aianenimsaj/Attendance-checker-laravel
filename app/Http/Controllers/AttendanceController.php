<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    // Teacher: Display all attendance
    public function index()
    {
        $attendances = Attendance::with('student')->latest()->get();
        return view('attendance.index', compact('attendances'));
    }

    // Teacher: Store attendance
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'date'       => 'required|date',
            'status'     => 'required|in:Present,Absent,Late',
        ]);

        Attendance::create($request->only(['student_id', 'date', 'status']));

        return back()->with('success', 'Attendance marked successfully!');
    }

    // Student: View their own attendances
    public function myAttendance()
    {
        $student_id = auth()->id();
        $attendances = Attendance::where('student_id', $student_id)->latest()->get();
        return view('attendance.my', compact('attendances'));
    }

    // Show single attendance details
    public function show($id)
    {
        $attendance = Attendance::with('student')->findOrFail($id);
        return view('attendance.show', compact('attendance'));
    }
}
