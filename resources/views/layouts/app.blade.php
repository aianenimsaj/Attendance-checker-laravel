<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Attendance Checker')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Attendance Checker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @php
                            $role = session('selected_role');
                        @endphp

                        @if($role === 'Admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                        @elseif($role === 'Teacher')
                            <li class="nav-item"><a class="nav-link" href="{{ route('teacher.dashboard') }}">Teacher Dashboard</a></li>
                        @elseif($role === 'Student')
                            <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">My Attendance</a></li>
                        @endif

                        <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                              @csrf
                       <button type="submit" class="nav-link btn btn-link text-decoration-none" style="color: inherit;">Logout</button>
                             </form>
                        </li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @yield('content')
    </div>

    <footer class="text-center py-3 bg-dark text-light mt-5">
        <small>© {{ date('Y') }} Attendance Checker | BSIT Project</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

