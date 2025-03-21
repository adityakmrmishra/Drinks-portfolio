@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="mb-4">Welcome, {{ Auth::user()->name }}!</h2>
                    
                    <!-- Debug information - only visible to current user -->
                    <div class="alert alert-info">
                        <p>
                            @if(Auth::user()->is_admin)
                                You are an <strong>Administrator</strong>
                            @else
                                You are a <strong>Regular User</strong>
                            @endif
                        </p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="bi bi-person-circle fs-1"></i>
                                    <h5 class="card-title mt-2">Profile</h5>
                                    <a href="{{ route('profile') }}" class="btn btn-light btn-sm mt-2">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="bi bi-gear-fill fs-1"></i>
                                    <h5 class="card-title mt-2">Settings</h5>
                                    <a href="{{ route('settings') }}" class="btn btn-light btn-sm mt-2">Manage Settings</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="bi bi-bell-fill fs-1"></i>
                                    <h5 class="card-title mt-2">Notifications</h5>
                                    <a href="{{ route('settings.notifications') }}" class="btn btn-light btn-sm mt-2">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Admin Panel Link - For admins only -->
            @if(Auth::user()->is_admin)
            <div class="card mt-4">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Administrator Access</h4>
                </div>
                <div class="card-body">
                    <p>Access the admin panel to manage users and products.</p>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Panel</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
