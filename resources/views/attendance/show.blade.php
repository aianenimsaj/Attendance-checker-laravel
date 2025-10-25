@extends('layouts.app')

@section('title', 'Attendance Details')

@section('content')
<div class="container">
    <h3>Attendance Details</h3>

    <div class="card p-3 mb-3">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>ID:</strong> {{ $attendance->id }}</li>
            <li class="list-group-item"><strong>Student Name:</strong> {{ $attendance->student->name ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Date:</strong> {{ $attendance->date }}</li>
            <li class="list-group-item"><strong>Time In:</strong> {{ $attendance->time_in }}</li>
            <li class="list-group-item"><strong>Time Out:</strong> {{ $attendance->time_out }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ $attendance->status }}</li>
        </ul>
    </div>

    <a href="{{ route('teacher.attendance') }}" class="btn btn-secondary">Back to Attendance List</a>
</div>
@endsection
