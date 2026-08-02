
@extends('layouts.app')

@section('title', 'Wedjed Pharmacy - Home')

@section('content')
    <!-- ========== SEARCH SECTION ========== -->
    <section class="search-section">
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search for medicines..." onkeydown="goToProductsSearch(event)">
                <span class="search-icon">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                </span>
            </div>
        </div>
    </section>

    <!-- ========== HERO SLIDER ========== -->
    <section class="hero-slider">
        <div class="slider">
            <img src="{{ asset('img/1.png') }}" alt="Banner 1" class="active">
            <img src="{{ asset('img/2.png') }}" alt="Banner 2">
            <img src="{{ asset('img/3.png') }}" alt="Banner 3">
            <img src="{{ asset('img/4.png') }}" alt="Banner 4">
            <img src="{{ asset('img/5.png') }}" alt="Banner 5">
            <img src="{{ asset('img/6.png') }}" alt="Banner 6">
            <img src="{{ asset('img/7.png') }}" alt="Banner 7">
            <img src="{{ asset('img/8.png') }}" alt="Banner 8">
        </div>
    </section>

    <!-- ========== CATEGORIES ========== -->
    <section class="categories-section">
        <div class="categories-container">
            <h2 class="section-title">Our Categories</h2>
            <div class="categories-grid" id="categoriesGrid">
                
                <a href="{{ route('products.index') }}" class="category-card" style="display:block; text-decoration:none;">
                    <img src="{{ asset('img/all.jpg') }}" alt="All Products">
                    <div class="category-overlay">
                        <h3>All</h3>
                    </div>
                </a>

                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->name]) }}" class="category-card" style="display:block; text-decoration:none;">
                    <img src="{{ asset($category->products->first()->image ?? 'img/placeholder.jpg') }}" alt="{{ $category->name }}">
                    <div class="category-overlay">
                        <h3>{{ $category->name }}</h3>
                    </div>
                </a>
                @endforeach
                
            </div>
        </div>
    </section>

    <!-- ========== PRODUCTS SECTION ========== -->
    <section class="products-section">
        <h2 id="productsTitle" class="section-title">Featured Products</h2>
        <div id="productsGrid" class="products-grid">
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <!-- ========== BRANDS ========== -->
    <div class="section-brands">
        <img class="imgbrand" src="{{ asset('img/brand.png') }}" alt="">
    </div>

    <!-- ========== SPECIAL OFFERS ========== -->
    <section class="offers-section">
        <div class="offers-container">
            <h2 class="section-title">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                Special Offers
            </h2>

            <!-- Offer Banner -->
            <div class="offer-banner">
                <div class="offer-banner-content">
                    <div class="offer-badge-large">HOT DEAL</div>
                    <h3>Get <span class="offer-percent">20% OFF</span> on your order!</h3>
                    <p>When your cart total exceeds <strong>1,000 EGP</strong></p>
                    <div class="offer-timer">
                        <span>Limited Time Offer</span>
                    </div>
                </div>
                <div class="offer-banner-image">
                    <svg viewBox="0 0 200 200" width="150" height="150">
                        <circle cx="100" cy="100" r="90" fill="rgba(255,255,255,0.1)"/>
                        <text x="100" y="90" text-anchor="middle" fill="#fff" font-size="48" font-weight="bold">20%</text>
                        <text x="100" y="125" text-anchor="middle" fill="#fff" font-size="20">OFF</text>
                    </svg>
                </div>
            </div>

            <!-- Offer Products Grid -->
            <div class="products-grid" id="offersGrid">
                @foreach($offers as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>

            <!-- Additional Offers Info -->
            <div class="offers-info-grid">
                <div class="offer-info-card">
                    <div class="offer-info-icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <h4>Free Delivery</h4>
                    <p>On orders over 500 EGP</p>
                </div>
                <div class="offer-info-card">
                    <div class="offer-info-icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
                    </div>
                    <h4>Bundle Deal</h4>
                    <p>Buy 3 Get 1 Free on Vitamins</p>
                </div>
                <div class="offer-info-card">
                    <div class="offer-info-icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <h4>Limited Time</h4>
                    <p>Flash sales every Friday</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadCart();
        // initSearch('searchInput', 'productsGrid', 'productsTitle'); // Handled via standard request now
        initSlider();
    });
</script>
@endsection
