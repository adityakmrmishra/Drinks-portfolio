@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>User Role Debug</h3>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <p>This page displays raw database values for debugging user roles.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Raw is_admin value</th>
                        <th>Type</th>
                        <th>Current User</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><code>{{ var_export($user->is_admin, true) }}</code></td>
                            <td><code>{{ gettype($user->is_admin) }}</code></td>
                            <td>{{ $user->id == Auth::id() ? 'Yes' : 'No' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
