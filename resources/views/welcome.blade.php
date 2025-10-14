<!DOCTYPE html>
<html>
<head>
    <title>Attendance Checker System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="text-center">
    <h1>Attendance Checker System</h1>
</header>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-5 text-center" style="width: 400px;">
        <h2 class="mb-4">Welcome!</h2>
        <p class="mb-4">Manage your attendance easily and efficiently.</p>
        <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
    </div>
</div>

<footer class="text-center py-4">
    &copy; {{ date('Y') }} Attendance Checker System
</footer>

</body>
</html>
