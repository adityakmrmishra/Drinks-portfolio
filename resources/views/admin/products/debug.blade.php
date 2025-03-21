@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Product Image Debug</h3>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <p>This page helps diagnose issues with product images.</p>
        </div>

        <h4>Storage Information</h4>
        <div class="mb-4">
            <p><strong>Storage Public Path:</strong> {{ public_path('storage') }}</p>
            <p><strong>Storage Link Status:</strong> 
                @if(file_exists(public_path('storage')) && is_link(public_path('storage')))
                    <span class="badge bg-success">OK</span> (Symbolic link exists)
                @else
                    <span class="badge bg-danger">MISSING</span> (Symbolic link does not exist)
                @endif
            </p>
        </div>
        
        <h4>Product Images</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Image Path</th>
                        <th>Full URL</th>
                        <th>File Exists</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Product::all() as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><code>{{ $product->image }}</code></td>
                            <td><code>{{ $product->image ? asset('storage/' . $product->image) : 'N/A' }}</code></td>
                            <td>
                                @if($product->image)
                                    @if(file_exists(storage_path('app/public/' . $product->image)))
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-thumbnail" width="100">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back to Products</a>
        </div>
    </div>
</div>
@endsection
