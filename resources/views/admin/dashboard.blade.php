@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h3 class="mb-0">Admin Dashboard</h3>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase mb-0">Products</h6>
                                <h2 class="my-2">
                                    @php
                                        try {
                                            $productCount = \App\Models\Product::count();
                                        } catch (\Exception $e) {
                                            $productCount = 0;
                                        }
                                    @endphp
                                    {{ $productCount }}
                                </h2>
                                <p class="mb-0">Total Products</p>
                            </div>
                            <div class="p-2 bg-primary-subtle bg-opacity-25 rounded">
                                <i class="bi bi-box-seam fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase mb-0">Users</h6>
                                <h2 class="my-2">{{ $users->count() }}</h2>
                                <p class="mb-0">Registered Users</p>
                            </div>
                            <div class="p-2 bg-success-subtle bg-opacity-25 rounded">
                                <i class="bi bi-people fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('admin.users.index') }}" class="text-white text-decoration-none">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase mb-0">Contacts</h6>
                                <h2 class="my-2">
                                    @php
                                        try {
                                            $contactCount = \App\Models\Contact::count();
                                        } catch (\Exception $e) {
                                            $contactCount = 0;
                                        }
                                    @endphp
                                    {{ $contactCount }}
                                </h2>
                                <p class="mb-0">Contact Messages</p>
                            </div>
                            <div class="p-2 bg-info-subtle bg-opacity-25 rounded">
                                <i class="bi bi-envelope fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('admin.contacts.index') }}" class="text-white text-decoration-none">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card bg-warning h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase mb-0">Unread</h6>
                                <h2 class="my-2">
                                    @php
                                        try {
                                            $unreadCount = \App\Models\Contact::unread()->count();
                                        } catch (\Exception $e) {
                                            $unreadCount = 0;
                                        }
                                    @endphp
                                    {{ $unreadCount }}
                                </h2>
                                <p class="mb-0">Unread Messages</p>
                            </div>
                            <div class="p-2 bg-warning-subtle bg-opacity-25 rounded">
                                <i class="bi bi-envelope-exclamation fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none text-dark">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recent Users</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users->sortByDesc('created_at')->take(5) as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($user->is_admin)
                                                    <span class="badge bg-danger">Admin</span>
                                                @else
                                                    <span class="badge bg-secondary">User</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('admin.products.create') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-plus-circle me-2"></i> Add New Product
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-pencil-square me-2"></i> Manage Products
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-person-gear me-2"></i> Manage Users
                            </a>
                            <a href="{{ route('admin.contacts.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-envelope-open me-2"></i> View Messages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
