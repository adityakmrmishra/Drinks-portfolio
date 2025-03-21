@extends('layouts.app')

@section('content')
<!-- Hero Section with Cocktail Theme -->
<div class="bg-dark text-white position-relative overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4">Discover Extraordinary Drinks</h1>
                <p class="lead mb-4">Explore our premium collection of handcrafted cocktails and refreshing mocktails. From classic recipes to creative concoctions, find your perfect drink.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Browse Collection</a>
                    <a href="#featured" class="btn btn-outline-light btn-lg">Featured Drinks</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('images/hero-cocktail.jpg') }}" alt="Cocktail Collection" class="img-fluid rounded-circle hero-image" 
                     style="max-width: 80%; filter: drop-shadow(0 0 1rem rgba(0,0,0,0.5));"
                     onerror="this.onerror=null; this.src='https://placehold.co/600x600?text=Signature+Cocktails'">
            </div>
        </div>
    </div>
    <!-- Decorative Elements -->
    <div class="position-absolute top-0 end-0 d-none d-lg-block" style="transform: translate(15%, -15%);">
        <div class="rounded-circle bg-primary opacity-10" style="width: 300px; height: 300px;"></div>
    </div>
    <div class="position-absolute bottom-0 start-0 d-none d-lg-block" style="transform: translate(-15%, 15%);">
        <div class="rounded-circle bg-info opacity-10" style="width: 200px; height: 200px;"></div>
    </div>
</div>

<!-- Featured Products Section -->
<div id="featured" class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Featured Drinks</h2>
        <p class="lead text-muted">Our most popular handcrafted creations</p>
    </div>
    
    <div class="row g-4">
        @php
            try {
                $featuredProducts = \App\Models\Product::where('is_active', true)
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
            } catch (\Exception $e) {
                $featuredProducts = collect();
            }
        @endphp

        @forelse($featuredProducts as $product)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($product->image && file_exists(public_path('storage/' . $product->image)))
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" 
                             alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="bg-light text-center py-5" style="height: 250px;">
                            <i class="bi bi-cup-straw text-primary" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h3 class="card-title h5">{{ $product->name }}</h3>
                        @if($product->type)
                            <span class="badge bg-{{ $product->type == 'cocktail' ? 'danger' : 'info' }} mb-2">
                                {{ ucfirst($product->type) }}
                            </span>
                        @endif
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-exclamation-circle text-muted" style="font-size: 3rem;"></i>
                <p class="mt-3 text-muted">No featured products available at the moment.</p>
            </div>
        @endforelse
    </div>
    
    <div class="text-center mt-5">
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">View All Drinks</a>
    </div>
</div>

<!-- Categories Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="p-4 bg-white rounded-4 shadow-sm">
                    <span class="badge bg-danger mb-2">Alcoholic</span>
                    <h3 class="h2 mb-3">Premium Cocktails</h3>
                    <p class="mb-4">Experience our selection of expertly crafted cocktails, from timeless classics to innovative signature drinks.</p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Classic Mojito</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Old Fashioned</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Espresso Martini</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Margarita</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('products.index', ['type' => 'alcoholic']) }}" class="btn btn-sm btn-outline-primary mt-4">Browse Cocktails</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-white rounded-4 shadow-sm">
                    <span class="badge bg-info mb-2">Non-Alcoholic</span>
                    <h3 class="h2 mb-3">Refreshing Mocktails</h3>
                    <p class="mb-4">Discover alcohol-free alternatives that don't compromise on flavor. Perfect for all occasions.</p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Tropical Paradise</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Blue Lagoon</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Virgin Daiquiri</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Berry Bliss</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('products.index', ['type' => 'non-alcoholic']) }}" class="btn btn-sm btn-outline-info mt-4">Browse Mocktails</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">What Our Customers Say</h2>
        <p class="lead text-muted">Hear from cocktail enthusiasts who love our drinks</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="card-text">"The Espresso Martini is incredible! Perfect balance of coffee and sweetness. My go-to evening cocktail now."</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">JS</div>
                        <div>
                            <h6 class="mb-0">James Smith</h6>
                            <small class="text-muted">Cocktail Enthusiast</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="card-text">"Tropical Paradise Mocktail is so refreshing! I love that I can enjoy a sophisticated drink without alcohol."</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">EJ</div>
                        <div>
                            <h6 class="mb-0">Emma Johnson</h6>
                            <small class="text-muted">Health Enthusiast</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <p class="card-text">"The Classic Mojito brought me right back to my vacation in Cuba. Perfectly balanced and so refreshing!"</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">MD</div>
                        <div>
                            <h6 class="mb-0">Michael Davis</h6>
                            <small class="text-muted">Travel Blogger</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Special Offer Banner -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <h2 class="display-5 fw-bold mb-3">Weekend Special Offer!</h2>
                <p class="lead mb-4">Get 15% off on our signature cocktails collection. Limited time offer!</p>
                <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">Shop Now</a>
            </div>
            <div class="col-lg-5 text-center">
                <div class="bg-white rounded-circle p-3 d-inline-block">
                    <div class="bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                        <div class="text-center">
                            <h3 class="display-4 fw-bold mb-0">15%</h3>
                            <p class="mb-0">OFF</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Custom CSS for this page -->
<style>
    .rounded-4 {
        border-radius: 1rem;
    }
    
    .hero-image {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0px);
        }
    }
    
    .bg-primary.opacity-10 {
        opacity: 0.1;
    }
    
    .bg-info.opacity-10 {
        opacity: 0.1;
    }
</style>
@endsection
