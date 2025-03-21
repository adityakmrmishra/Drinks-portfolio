@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Manage Users</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-person-plus me-1"></i> Add New User
        </button>
    </div>
    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(isset($user->is_admin) && $user->is_admin == 1)
                                    <span class="badge bg-success">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </td>
                            <td>{{ isset($user->created_at) ? \Carbon\Carbon::parse($user->created_at)->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    @if(Auth::id() != $user->id)
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        
                                        <form id="delete-form-{{ $user->id }}" 
                                              action="{{ route('admin.users.destroy', $user->id) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($users, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete user <strong id="deleteUserName"></strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete User</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId, userName) {
        document.getElementById('deleteUserName').textContent = userName;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
        
        document.getElementById('confirmDeleteBtn').onclick = function() {
            document.getElementById('delete-form-' + userId).submit();
        };
    }
</script>
@endsection
