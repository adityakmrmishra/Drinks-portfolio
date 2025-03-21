@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Edit Product: {{ $product->name }}</h3>
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

                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="" disabled {{ !old('type', $product->type) ? 'selected' : '' }}>Select drink type</option>
                                <option value="cocktail" {{ old('type', $product->type) == 'cocktail' ? 'selected' : '' }}>Cocktail (Alcoholic)</option>
                                <option value="mocktail" {{ old('type', $product->type) == 'mocktail' ? 'selected' : '' }}>Mocktail (Non-Alcoholic)</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" min="0" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock Quantity</label>
                                <input type="number" min="0" 
                                       class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                         class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <div class="form-text">Leave empty to keep the current image. Recommended size: 800x600px (Max: 2MB)</div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" 
                                       name="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Product Active</label>
                            </div>
                            <div class="form-text">Inactive products won't be visible to customers</div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
