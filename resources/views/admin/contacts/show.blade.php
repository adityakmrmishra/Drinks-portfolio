@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Contact Details</h3>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Contacts
            </a>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <h4>{{ $contact->subject }}</h4>
                        <div class="text-muted mb-3">
                            From: <strong>{{ $contact->name }}</strong> &lt;{{ $contact->email }}&gt;
                        </div>
                        <div class="text-muted mb-4">
                            Received: {{ $contact->created_at->format('F d, Y \a\t h:i A') }}
                        </div>
                        
                        <div class="card">
                            <div class="card-body bg-light">
                                <p class="card-text">{{ $contact->message }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="mailto:{{ $contact->email }}" class="btn btn-primary">
                            <i class="bi bi-reply-fill me-1"></i> Reply
                        </a>
                        
                        <form action="{{ route('admin.contacts.toggle-read', $contact) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-warning">
                                <i class="bi {{ $contact->read_at ? 'bi-envelope me-1' : 'bi-envelope-open me-1' }}"></i>
                                Mark as {{ $contact->read_at ? 'Unread' : 'Read' }}
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this contact?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Contact Information</div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="fw-bold small text-muted">Name</div>
                                <div>{{ $contact->name }}</div>
                            </div>
                            <div class="list-group-item">
                                <div class="fw-bold small text-muted">Email</div>
                                <div>
                                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="fw-bold small text-muted">Status</div>
                                <div>
                                    @if($contact->read_at)
                                        <span class="badge bg-success">Read on {{ $contact->read_at->format('M d, Y H:i') }}</span>
                                    @else
                                        <span class="badge bg-danger">Unread</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
