<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function viewAttendance()
    {
        return view('student.attendance'); // Make sure this view exists
    }

    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'student_id' => 'required|string|unique:students,student_id',
            'name'       => 'required|string|max:255',
            'password'   => 'required|string|min:6',
            'course'     => 'required|string|max:255',
        ], [
            'student_id.required' => 'Student ID is required.',
            'student_id.string'   => 'Student ID must be a valid string (e.g., 2025-005).',
            'student_id.unique'   => 'This Student ID is already taken.',
            'name.required'       => 'Name is required.',
            'password.required'   => 'Password is required.',
            'password.min'        => 'Password must be at least 6 characters.',
            'course.required'     => 'Course is required.',
        ]);

        // Create student
        Student::create([
            'student_id' => $request->student_id,
            'name'       => $request->name,
            'password'   => Hash::make($request->password),
            'course'     => $request->course,
        ]);

        return redirect()->route('admin.students')->with('success', 'Student added successfully.');
    }

    public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $request->validate([
        'name'   => 'required|string|max:255',
        'course' => 'required|string|max:255',
    ], [
        'name.required'   => 'Name is required.',
        'course.required' => 'Course is required.',
    ]);

    $student->update($request->only(['name', 'course']));

    return redirect()->route('admin.students')->with('success', 'Student updated successfully.');
}

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students')
                         ->with('success', 'Student deleted successfully.');
    }
}

