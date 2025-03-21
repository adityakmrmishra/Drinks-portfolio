@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="list-group mb-4">
                <a href="{{ route('settings') }}" class="list-group-item list-group-item-action active">
                    <i class="bi bi-gear me-2"></i> General
                </a>
                <a href="{{ route('settings.password') }}" class="list-group-item list-group-item-action">
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
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('General Settings') }}</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">{{ __('Theme') }}</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input theme-option" type="radio" name="theme" id="light" value="light" {{ $userSettings['theme'] == 'light' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="light">Light</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input theme-option" type="radio" name="theme" id="dark" value="dark" {{ $userSettings['theme'] == 'dark' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="dark">Dark</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input theme-option" type="radio" name="theme" id="system" value="system" {{ $userSettings['theme'] == 'system' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="system">System Default</label>
                                </div>
                            </div>
                            @error('theme')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to the theme radio buttons
        const themeOptions = document.querySelectorAll('.theme-option');
        themeOptions.forEach(function(option) {
            option.addEventListener('change', function() {
                if (this.checked) {
                    // Apply theme immediately
                    window.applyTheme(this.value);
                }
            });
        });
    });
</script>
@endpush
