@extends('layouts.app')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
            @if($product->image && file_exists(public_path('storage/' . $product->image)))
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" 
                     alt="{{ $product->name }}">
            @else
                <div class="bg-light text-center py-5 rounded">
                    <i class="bi bi-cup-straw text-primary" style="font-size: 8rem;"></i>
                    <p class="text-muted mt-3">No image available</p>
                </div>
            @endif
        </div>
        
        <div class="col-md-7">
            <h1 class="mb-3">{{ $product->name }}</h1>
            
            <div class="mb-2">
                <span class="badge bg-{{ $product->type == 'cocktail' ? 'danger' : ($product->type == 'mocktail' ? 'info' : 'secondary') }}">
                    {{ $product->type ? ucfirst($product->type) : 'Unspecified' }}
                </span>
            </div>
            
            <div class="mb-3">
                <h3 class="text-primary">${{ number_format($product->price, 2) }}</h3>
                
                @if($product->stock > 0)
                    <p class="text-success mb-0">
                        <i class="bi bi-check-circle-fill"></i> 
                        In Stock ({{ $product->stock }} available)
                    </p>
                @else
                    <p class="text-danger mb-0">
                        <i class="bi bi-x-circle-fill"></i>
                        Out of Stock
                    </p>
                @endif
            </div>
            
            <hr>
            
            <div class="mb-4">
                <h4>Product Description</h4>
                <div class="lh-lg">
                    {{ $product->description }}
                </div>
            </div>
            
            @if($product->stock > 0)
                <div class="d-grid gap-2 mb-4">
                    <a href="{{ route('contact.index', ['subject' => 'Inquiry about: '.$product->name, 'message' => 'Hi, I\'m interested in purchasing the '.$product->name.'. Please provide more information about availability and ordering.']) }}" 
                       class="btn btn-primary btn-lg">
                        <i class="bi bi-chat-text-fill me-2"></i> Contact to Purchase
                    </a>
                    <p class="text-muted text-center small mt-2">
                        <i class="bi bi-info-circle me-1"></i> This is a portfolio. Please use the contact form to inquire about purchasing.
                    </p>
                </div>
            @else
                <button class="btn btn-secondary w-100 mb-3" disabled>
                    <i class="bi bi-cart-x me-2"></i> Currently Unavailable
                </button>
            @endif
            
            <!-- <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-heart"></i> Add to Wishlist
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-share"></i> Share
                </button>
            </div> -->
            
            @if(Auth::check() && Auth::user()->is_admin)
                <div class="mt-4 p-3 bg-light rounded">
                    <h5 class="text-primary">Admin Options</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit Product
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Delete Product
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Additional product information section -->
    <!-- <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="specs-tab" data-bs-toggle="tab" 
                                    data-bs-target="#specs-content" type="button" role="tab" aria-selected="true">
                                Specifications
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews-content" type="button" role="tab" aria-selected="false">
                                Reviews
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                                    data-bs-target="#shipping-content" type="button" role="tab" aria-selected="false">
                                Shipping & Returns
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="productTabContent">
                        <div class="tab-pane fade show active" id="specs-content" role="tabpanel">
                            <p class="text-muted">Product specifications will be displayed here.</p>
                        </div>
                        <div class="tab-pane fade" id="reviews-content" role="tabpanel">
                            <p class="text-muted">Product reviews will be displayed here.</p>
                        </div>
                        <div class="tab-pane fade" id="shipping-content" role="tabpanel">
                            <h5>Shipping Policy</h5>
                            <p>Standard shipping takes 3-5 business days.</p>
                            
                            <h5>Return Policy</h5>
                            <p>Returns accepted within 30 days of purchase.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
