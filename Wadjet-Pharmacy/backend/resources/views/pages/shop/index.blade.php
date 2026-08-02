@extends('layouts.app')

@php
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products */
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories */
@endphp

@section('title', 'Products - Wedjed Pharmacy')

@section('styles')

@endsection

@section('content')


    <!-- ========== SEARCH SECTION ========== -->
    <section class="search-section">
        <div class="search-container">
            <form method="GET" action="{{ route('products.index') }}" class="search-box" style="display:flex; width: 100%;">
                <input type="text" name="search" id="searchInput" placeholder="Search for products... (e.g., Panadol, Vitamin)" autocomplete="off" value="{{ request('search') }}">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button type="submit" class="search-icon" style="background: none; border: none; cursor: pointer; padding: 10px;">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                </button>
            </form>
        </div>
    </section>
    <!-- ========== CATEGORIES ========== -->
    <section class="categories-section">
        <div class="categories-container">
            <h2 class="section-title">Browse by Category</h2>
            <div class="categories-grid" id="categoriesGrid">
                <a href="{{ route('products.index') }}" class="category-card {{ !request('category') ? 'active' : '' }}" style="display:block; text-decoration:none;">
                    <img src="{{ asset('img/all.jpg') }}" alt="All Products">
                    <div class="category-overlay">
                        <h3>All</h3>
                    </div>
                </a>

                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->name]) }}" class="category-card {{ request('category') == $category->name ? 'active' : '' }}" style="display:block; text-decoration:none;">
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
        <div class="products-container">
            <h2 class="section-title" id="productsTitle">
                {{ request('search') ? 'Search Results for "'.request('search').'"' : (request('category') ? request('category') : 'All Products') }}
            </h2>
            
            @if($products->isEmpty())
                <div class="no-results" style="text-align:center; padding: 50px;">
                    <svg viewBox="0 0 24 24" width="80" height="80" fill="none" stroke="#ccc" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <h3>No Results Found</h3>
                    <p>Try searching with different keywords</p>
                </div>
            @else
                <div class="products-grid" id="productsGrid">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
        });
    </script>

@endsection