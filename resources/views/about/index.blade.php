@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">About Our Cocktail Shop</h1>
            
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-5">
                    <h2 class="h4 mb-4">Our Story</h2>
                    <p>Founded in 2020, our cocktail and mocktail company began with a simple mission: to provide exceptional drink experiences for everyone, regardless of whether they consume alcohol or not.</p>
                    
                    <p>What started as a small family business has grown into a beloved fixture in the community, known for our attention to detail, premium ingredients, and innovative drink creations.</p>
                    
                    <div class="row my-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <img src="https://images.unsplash.com/photo-1605270012917-bf157c5a9541" 
                                 class="img-fluid rounded" 
                                 alt="Bartender mixing drinks"
                                 onerror="this.src='https://placehold.co/600x400?text=Mixology+in+Action';this.onerror='';">
                        </div>
                        <div class="col-md-6">
                            <img src="https://images.unsplash.com/photo-1609951651556-5334e2706168" 
                                 class="img-fluid rounded" 
                                 alt="Cocktail being served"
                                 onerror="this.src='https://placehold.co/600x400?text=Premium+Ingredients';this.onerror='';">
                        </div>
                    </div>
                    
                    <h2 class="h4 mb-4">Our Philosophy</h2>
                    <p>We believe that every drink should tell a story. Our mixologists are trained to create not just beverages, but experiences that engage all the senses. Whether you're enjoying one of our signature cocktails or a refreshing mocktail, you can expect:</p>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item bg-transparent border-start-0 border-end-0">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Premium, responsibly sourced ingredients
                        </li>
                        <li class="list-group-item bg-transparent border-start-0 border-end-0">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Expertly crafted drink recipes that balance flavor and presentation
                        </li>
                        <li class="list-group-item bg-transparent border-start-0 border-end-0">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Options for all preferences and dietary requirements
                        </li>
                        <li class="list-group-item bg-transparent border-start-0 border-end-0">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Sustainable practices and eco-friendly packaging
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="h4 mb-4">Meet Our Mixology Team</h2>
                    
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="rounded-circle mx-auto mb-3 bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 150px; height: 150px;">
                                <i class="bi bi-person-circle text-secondary" style="font-size: 5rem;"></i>
                            </div>
                            <h5>Alex Johnson</h5>
                            <p class="text-muted">Head Mixologist</p>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <div class="rounded-circle mx-auto mb-3 bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 150px; height: 150px;">
                                <i class="bi bi-person-circle text-secondary" style="font-size: 5rem;"></i>
                            </div>
                            <h5>Jordan Smith</h5>
                            <p class="text-muted">Creative Director</p>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <div class="rounded-circle mx-auto mb-3 bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 150px; height: 150px;">
                                <i class="bi bi-person-circle text-secondary" style="font-size: 5rem;"></i>
                            </div>
                            <h5>Taylor Reed</h5>
                            <p class="text-muted">Specialist in Non-Alcoholic Creations</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary">Contact Our Team</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
