@extends('layouts.app')
@section('title', 'Manage Classes')

@section('content')
<div class="container">
    <h2>Manage Classes</h2>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Class Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Class</div>
        <div class="card-body">
            <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Class Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Subject:</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Class</button>
            </form>
        </div>
    </div>

    <!-- Class List -->
    <div class="card">
        <div class="card-header">Class List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Subject</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->subject }}</td>
                        <td>
                            <!-- Update Class Form -->
                            <form action="{{ route('admin.classes.update', $class->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $class->name }}" class="form-control mb-1" placeholder="Class Name">
                                <input type="text" name="subject" value="{{ $class->subject }}" class="form-control mb-1" placeholder="Subject">
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </form>

                            <!-- Delete Class Form -->
                            <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($classes->isEmpty())
                <p>No classes found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
