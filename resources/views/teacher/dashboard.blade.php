@extends('layouts.app')
@section('title', 'Teacher Dashboard')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="mb-3">Welcome, {{ Auth::user()->full_name }}</h3>
    <p class="text-muted">Here are your available actions:</p>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5>Mark Attendance</h5>
                    <p>Record attendance for your students</p>
                    <a href="{{ route('teacher.markAttendance') }}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5>View Attendance</h5>
                    <p>Check attendance history for your class</p>
                    <a href="{{ route('teacher.viewAttendance') }}" class="btn btn-success">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
