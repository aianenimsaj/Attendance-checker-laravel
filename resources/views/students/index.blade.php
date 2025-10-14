@extends('layouts.app')
@section('title', 'Manage Students')

@section('content')
<div class="container">
    <h2>Manage Students</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Add Student Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Student</div>
        <div class="card-body">
            <form action="{{ route('admin.students.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>ID Number:</label>
                    <input type="text" name="student_id" class="form-control" value="{{ old('student_id') }}" required>
                </div>
                <div class="mb-3">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Course:</label>
                    <input type="text" name="course" class="form-control" value="{{ old('course') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </form>
        </div>
    </div>

    <!-- Student List -->
    <div class="card">
        <div class="card-header">Student List</div>
        <div class="card-body">
            @if($students->isEmpty())
                <p>No students found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->course }}</td>
                            <td>
                                <!-- Update Form -->
                                <form action="{{ route('admin.students.update', $student->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $student->name }}" class="form-control mb-1" placeholder="Name" required>
                                    <input type="text" name="course" value="{{ $student->course }}" class="form-control mb-1" placeholder="Course" required>
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </form>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

