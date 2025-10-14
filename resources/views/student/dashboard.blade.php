@extends('layouts.app')
@section('title', 'My Attendance')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="mb-3">Welcome, {{ Auth::user()->full_name }}</h3>
    <p class="text-muted">You can view your attendance records here.</p>

    <a href="{{ route('student.viewAttendance') }}" class="btn btn-primary">View My Attendance</a>
</div>
@endsection