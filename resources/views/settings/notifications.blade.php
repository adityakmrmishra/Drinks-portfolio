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
                <a href="{{ route('settings.notifications') }}" class="list-group-item list-group-item-action active">
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
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">{{ __('Notification Settings') }}</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.notifications.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <h5 class="mb-3">Email Notifications</h5>
                        
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="email_news" name="email_news" checked>
                            <label class="form-check-label" for="email_news">News and Updates</label>
                        </div>
                        
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="email_account" name="email_account" checked>
                            <label class="form-check-label" for="email_account">Account Activity</label>
                        </div>
                        
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="email_marketing" name="email_marketing">
                            <label class="form-check-label" for="email_marketing">Marketing and Promotions</label>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Push Notifications</h5>
                        
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="push_all" name="push_all" checked>
                            <label class="form-check-label" for="push_all">Enable All Push Notifications</label>
                        </div>
                        
                        <button type="submit" class="btn btn-info text-white mt-3">Save Notification Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
