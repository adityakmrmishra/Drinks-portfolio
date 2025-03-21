@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="list-group mb-4">
                <a href="{{ route('settings') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-gear me-2"></i> General
                </a>
                <a href="{{ route('settings.password') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-lock me-2"></i> Security
                </a>
                <a href="{{ route('settings.notifications') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-bell me-2"></i> Notifications
                </a>
                <a href="{{ route('settings.privacy') }}" class="list-group-item list-group-item-action active">
                    <i class="bi bi-eye me-2"></i> Privacy
                </a>
            </div>
            
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">{{ __('Privacy Settings') }}</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.privacy.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <h5 class="mb-3">Profile Visibility</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Who can see your profile?</label>
                            <select class="form-select" name="profile_visibility">
                                <option value="public">Everyone</option>
                                <option value="registered">Registered Users Only</option>
                                <option value="private">Only Me</option>
                            </select>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Data Usage</h5>
                        
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="allow_analytics" name="allow_analytics" checked>
                            <label class="form-check-label" for="allow_analytics">
                                Allow anonymous analytics to improve the service
                            </label>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="allow_cookies" name="allow_cookies" checked>
                            <label class="form-check-label" for="allow_cookies">
                                Allow cookies for improved experience
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-secondary mt-3">Save Privacy Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
