@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Edit Profile') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 text-center">
                            <div class="avatar-placeholder mb-3">
                                <i class="bi bi-person-circle" style="font-size: 80px; color: #6c757d;"></i>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-camera me-1"></i> Change Photo
                            </button>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="form-label">{{ __('Bio') }}</label>
                            <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="3">{{ old('bio', Auth::user()->bio ?? '') }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">{{ __('Password') }}</h5>
                </div>
                <div class="card-body">
                    <p>Want to update your password?</p>
                    <a href="{{ route('settings.password') }}" class="btn btn-outline-warning">
                        <i class="bi bi-key me-1"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
