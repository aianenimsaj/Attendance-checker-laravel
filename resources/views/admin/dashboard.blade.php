@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="card shadow-sm p-4">
    <h3 class="mb-3">Admin Dashboard</h3>
    <p class="text-muted">Manage the system data below:</p>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h5>Manage Students</h5>
                    <a href="{{ route('admin.students') }}" class="btn btn-primary">Open</a>
                </div>
            </div>
        </div>

        {{-- Placeholder buttons until you create the controllers/routes --}}
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h5>Manage Classes</h5>
                    <button class="btn btn-success" disabled>Coming Soon</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h5>Enroll Students</h5>
                    <button class="btn btn-warning" disabled>Coming Soon</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
