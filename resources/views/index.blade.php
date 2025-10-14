@extends('layouts.app')

@section('content')
    @if(Auth::check())
        @if(Auth::user()->role === 'student')
            @include('partials.student-dashboard')
        @elseif(Auth::user()->role === 'teacher')
            @include('partials.teacher-dashboard')
        @endif
    @else
        <p>No user logged in yet.</p>

        <!-- Login Section -->
        <section id="login-section" class="active">
            <h2>Login</h2>
            <form id="login-form" autocomplete="off" action="{{ route('login.post') }}" method="POST">
                @csrf
                <label>ID Number:</label>
                <input type="text" name="idnumber" required>
                
                <label>Password:</label>
                <input type="password" name="password" required>
                
                <label>Role:</label>
                <select name="role" required>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
                
                <button type="submit">Login</button>
            </form>
            <div id="login-error" class="error"></div>
        </section>
    @endif

    <!-- Dashboard Section -->
    <section id="dashboard-section" style="display:none;">
        <h2>Welcome, <span id="user-name"></span></h2>
        <p>ID Number: <span id="user-id"></span></p>
        <p>Subject: <span id="class-subject"></span></p>

        <nav>
            <button onclick="showSection('add-student-section')">Add Student</button>
            <button onclick="showSection('update-subject-section')">Update Subject</button>
            <button onclick="showSection('search-student-section')">Search Student</button>
            <button onclick="showSection('mark-attendance-section')">Mark Attendance</button>
            <button onclick="showSection('view-attendance-section')">View Attendance</button>
        </nav>
    </section>

    <!-- Add Student Section -->
    <section id="add-student-section" style="display:none;">
        <h2>Add Student</h2>
        <form id="add-student-form" action="{{ route('admin.students.store') }}" method="POST">
            @csrf
            <label>ID Number:</label>
            <input type="text" name="student_id" required>
            
            <label>Name:</label>
            <input type="text" name="name" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Add Student</button>
            <button type="button" onclick="showSection('dashboard-section')">Back</button>
        </form>
        <div id="add-student-success" class="success"></div>
    </section>

    <!-- Mark Attendance Section -->
    <section id="mark-attendance-section" style="display:none;">
        <h2>Mark Attendance</h2>
        <form id="mark-attendance-form" action="{{ route('teacher.attendance.store') }}" method="POST">
            @csrf
            <label>Student ID:</label>
            <input type="text" name="student_id" required>
            
            <label>Status:</label>
            <select name="status" required>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
            </select>
            
            <button type="submit">Mark Attendance</button>
            <button type="button" onclick="showSection('dashboard-section')">Back</button>
        </form>
        <div id="mark-attendance-success" class="success"></div>
    </section>

    <!-- View Attendance Section -->
    <section id="view-attendance-section" style="display:none;">
        <h2>View Attendance</h2>
        <a href="{{ route('teacher.attendance.view') }}" target="_blank">View Attendance Records</a>
        <button type="button" onclick="showSection('dashboard-section')">Back</button>
    </section>

    <!-- Optional: Search Student Section -->
    <section id="search-student-section" style="display:none;">
        <h2>Search Student</h2>
        <form id="search-student-form" action="#" method="GET">
            <label>Student ID:</label>
            <input type="text" name="student_id" required>
            <button type="submit">Search</button>
            <button type="button" onclick="showSection('dashboard-section')">Back</button>
        </form>
    </section>

    <!-- Optional: Update Subject Section -->
    <section id="update-subject-section" style="display:none;">
        <h2>Update Subject</h2>
        <form id="update-subject-form" action="#" method="POST">
            @csrf
            <label>Subject Name:</label>
            <input type="text" name="subject_name" required>
            <button type="submit">Update</button>
            <button type="button" onclick="showSection('dashboard-section')">Back</button>
        </form>
    </section>
@endsection

