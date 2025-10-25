@extends('layouts.app')

@section('title', 'Attendance List')

@section('content')
<div class="container">
    <h3>Attendance List</h3>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Attendance table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>
                        <a href="{{ route('teacher.attendance.show', $attendance->id) }}">
                            {{ $attendance->student->name ?? 'N/A' }}
                        </a>
                    </td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->time_in }}</td>
                    <td>{{ $attendance->time_out }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mark attendance form -->
    <h4>Mark Attendance</h4>
    <form action="{{ route('teacher.attendance.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" class="form-select" required>
                @foreach(App\Models\User::where('role', 'Student')->get() as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Late">Late</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mark Attendance</button>
    </form>
</div>
@endsection
