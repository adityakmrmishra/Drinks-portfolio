@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('My Profile') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="text-center mb-4">
                        <div class="avatar-placeholder mb-3">
                            <i class="bi bi-person-circle" style="font-size: 80px; color: #6c757d;"></i>
                        </div>
                        <h3>{{ Auth::user()->name }}</h3>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">{{ __('Personal Information') }}</div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Name:</div>
                                        <div class="col-md-8">{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Email:</div>
                                        <div class="col-md-8">{{ Auth::user()->email }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Joined On:</div>
                                        <div class="col-md-8">{{ Auth::user()->created_at->format('F d, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                    <i class="bi bi-pencil-square me-1"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
