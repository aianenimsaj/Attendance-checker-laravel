<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;

class AttendanceController extends Controller
{
    // Teacher: Mark Attendance
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        Attendance::create($request->all());

        return back()->with('success', 'Attendance marked successfully!');
    }

    // Teacher: View all
    public function index()
    {
        $attendances = Attendance::with('student')->latest()->get();
        return view('attendance.index', compact('attendances'));
    }

    // Student: View their own
    public function myAttendance($id)
    {
        $attendances = Attendance::where('student_id', $id)->latest()->get();
        return view('attendance.my', compact('attendances'));
    }
}

