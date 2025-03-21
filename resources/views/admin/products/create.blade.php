@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Add New Product</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Products
        </a>
    </div>
    <div class="card-body">
        @include('components.flash-message')
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select drink type</option>
                    <option value="cocktail" {{ old('type') == 'cocktail' ? 'selected' : '' }}>Cocktail (Alcoholic)</option>
                    <option value="mocktail" {{ old('type') == 'mocktail' ? 'selected' : '' }}>Mocktail (Non-Alcoholic)</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" step="0.01" min="0" 
                           class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock Quantity</label>
                    <input type="number" min="0" 
                           class="form-control @error('stock') is-invalid @enderror" 
                           id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*">
                <div class="form-text">
                    Recommended size: 800x600px. Maximum size: <strong>2MB</strong>. 
                    Supported formats: JPG, PNG, GIF.
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" 
                           name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Product Active</label>
                </div>
                <div class="form-text">Inactive products won't be visible to customers</div>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Create Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Make sure the script is properly scoped to avoid conflicts
    document.addEventListener('DOMContentLoaded', function() {
        // Image Preview Functionality
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Check if an existing preview should be removed
                    const existingPreview = document.getElementById('image-preview-container');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Create new preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewContainer = document.createElement('div');
                        previewContainer.id = 'image-preview-container';
                        previewContainer.className = 'mt-2';
                        
                        const previewImg = document.createElement('img');
                        previewImg.src = e.target.result;
                        previewImg.className = 'img-thumbnail';
                        previewImg.style.maxHeight = '200px';
                        
                        previewContainer.appendChild(previewImg);
                        
                        document.getElementById('image').parentNode.appendChild(previewContainer);
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection