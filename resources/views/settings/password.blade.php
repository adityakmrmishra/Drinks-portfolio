@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="list-group mb-4">
                <a href="{{ route('settings') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-gear me-2"></i> General
                </a>
                <a href="{{ route('settings.password') }}" class="list-group-item list-group-item-action active">
                    <i class="bi bi-shield-lock me-2"></i> Security
                </a>
                <a href="{{ route('settings.notifications') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-bell me-2"></i> Notifications
                </a>
                <a href="{{ route('settings.privacy') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-eye me-2"></i> Privacy
                </a>
            </div>
            
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">{{ __('Change Password') }}</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('New Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        
                        <button type="submit" class="btn btn-warning">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
