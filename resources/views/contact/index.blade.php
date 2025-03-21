@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">Contact Us</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h3 class="h5 mb-4">Send Us a Message</h3>
                            
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" name="subject" value="{{ old('subject', $prefill['subject'] ?? '') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" name="message" rows="5" required>{{ old('message', $prefill['message'] ?? '') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                        
                        <div class="col-md-6">
                            <h3 class="h5 mb-4">Our Information</h3>
                            
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="bi bi-geo-alt-fill text-primary me-2"></i> 
                                    <strong>Address:</strong>
                                    <p class="ms-4 mb-0">123 Cocktail Street</p>
                                    <p class="ms-4 mb-0">City, State 12345</p>
                                </li>
                                
                                <li class="mb-3">
                                    <i class="bi bi-telephone-fill text-primary me-2"></i>
                                    <strong>Phone:</strong>
                                    <p class="ms-4 mb-0">+1 (555) 123-4567</p>
                                </li>
                                
                                <li class="mb-3">
                                    <i class="bi bi-envelope-fill text-primary me-2"></i>
                                    <strong>Email:</strong>
                                    <p class="ms-4 mb-0">info@example.com</p>
                                </li>
                                
                                <li class="mb-4">
                                    <i class="bi bi-clock-fill text-primary me-2"></i>
                                    <strong>Hours:</strong>
                                    <p class="ms-4 mb-0">Monday - Friday: 9AM - 9PM</p>
                                    <p class="ms-4 mb-0">Saturday - Sunday: 10AM - 11PM</p>
                                </li>
                            </ul>
                            
                            <h3 class="h5 mb-3">Follow Us</h3>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-decoration-none social-icon">
                                    <i class="bi bi-facebook fs-4"></i>
                                </a>
                                <a href="#" class="text-decoration-none social-icon">
                                    <i class="bi bi-instagram fs-4"></i>
                                </a>
                                <a href="#" class="text-decoration-none social-icon">
                                    <i class="bi bi-twitter fs-4"></i>
                                </a>
                                <a href="#" class="text-decoration-none social-icon">
                                    <i class="bi bi-pinterest fs-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12345.67890!2d-73.9876543!3d40.7654321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ1JzU1LjYiTiA3M8KwNTknMTUuNiJX!5e0!3m2!1sen!2sus!4v1234567890!5m2!1sen!2sus" 
                                width="600" height="450" style="border:0;" 
                                allowfullscreen="" loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .social-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.05);
        color: var(--bs-primary);
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background-color: var(--bs-primary);
        color: white;
        transform: translateY(-3px);
    }
</style>
@endsection
