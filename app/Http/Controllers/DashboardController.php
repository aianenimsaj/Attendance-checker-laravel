<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function teacherDashboard()
    {
        return view('teacher.dashboard');
    }

    public function studentDashboard()
    {
        return view('student.dashboard');
    }

    public function viewAttendance()
    {
        return view('student.attendance');
    }
}