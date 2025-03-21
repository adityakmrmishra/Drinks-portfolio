@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">
                Our Products
                @if(isset($currentType))
                    @if($currentType == 'alcoholic')
                        <small class="text-muted">- Alcoholic Cocktails</small>
                    @elseif($currentType == 'non-alcoholic')
                        <small class="text-muted">- Non-Alcoholic Mocktails</small>
                    @endif
                @endif
            </h1>
            
            <div class="mb-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary {{ !isset($currentType) ? 'active' : '' }}">All Drinks</a>
                <a href="{{ route('products.index', ['type' => 'alcoholic']) }}" class="btn btn-outline-danger {{ isset($currentType) && $currentType == 'alcoholic' ? 'active' : '' }}">Cocktails</a>
                <a href="{{ route('products.index', ['type' => 'non-alcoholic']) }}" class="btn btn-outline-info {{ isset($currentType) && $currentType == 'non-alcoholic' ? 'active' : '' }}">Mocktails</a>
            </div>
            
            @if($products->isEmpty())
                <div class="alert alert-info">
                    No products available at the moment. Please check back later.
                </div>
            @else
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100">
                                @if($product->image && file_exists(public_path('storage/' . $product->image)))
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" 
                                         alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light text-center py-5" style="height: 200px;">
                                        <i class="bi bi-cup-straw text-primary" style="font-size: 5rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <!-- <span class="badge bg-{{ $product->type == 'cocktail' ? 'danger' : ($product->type == 'mocktail' ? 'info' : 'secondary') }} mb-2">
                                        {{ $product->type ? ucfirst($product->type) : 'Unspecified' }}
                                    </span> -->
                                    <p class="card-text text-muted mb-2">${{ number_format($product->price, 2) }}</p>
                                    <!-- <p class="card-text small text-truncate mb-3">{{ $product->description }}</p> -->
                                    <div class="mt-auto">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary w-100">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                                @if($product->stock < 5 && $product->stock > 0)
                                    <div class="card-footer text-bg-warning text-center py-1">
                                        <small>Only {{ $product->stock }} left in stock!</small>
                                    </div>
                                @elseif($product->stock == 0)
                                    <div class="card-footer text-bg-danger text-center py-1">
                                        <small>Out of stock</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
