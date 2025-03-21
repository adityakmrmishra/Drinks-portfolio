@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h3>Manage Contacts</h3>
            @if(isset($unreadCount) && $unreadCount > 0)
                <span class="badge bg-danger">{{ $unreadCount }} Unread</span>
            @endif
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(isset($tableNotExists) && $tableNotExists)
            <div class="alert alert-warning">
                <h4 class="alert-heading">Database Setup Required</h4>
                <p>The contacts table doesn't exist in your database. Please run the following command to create it:</p>
                <pre><code>php artisan migrate</code></pre>
                <p>This will create the necessary database tables for storing contact form submissions.</p>
            </div>
        @elseif($contacts->isEmpty())
            <div class="alert alert-info">No contacts found.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr class="{{ $contact->read_at ? '' : 'table-active' }}">
                                <!-- <td>{{ $contact->id }}</td> -->
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ Str::limit($contact->subject, 30) }}</td>
                                <td>{{ $contact->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($contact->read_at)
                                        <span class="badge bg-success">Read</span>
                                    @else
                                        <span class="badge bg-danger">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.toggle-read', $contact) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="bi {{ $contact->read_at ? 'bi-envelope' : 'bi-envelope-open' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    /* Highlight unread messages with a subtle indicator */
    .table-active {
        font-weight: 500;
    }
</style>
@endsection
