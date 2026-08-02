@extends('layouts.app')

@php
    /** @var \App\Models\Product $product */
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $relatedProducts */
@endphp

@section('title', $product->name . ' - Wedjed Pharmacy')

@section('content')

<!-- Product Details -->
<section class="product-details">
    <div class="product-details-container">

        <div class="product-image-box" style="position: relative;">
            @if($product->has_offer)
                <span class="offer-badge" style="position:absolute; top: 10px; left: 10px; background:#FF4C4C; color:white; padding:5px 10px; border-radius:5px; font-weight: bold; z-index: 10;">Special Offer</span>
            @endif
            <img id="detailsImage" src="{{ asset($product->image ?: 'img/placeholder.jpg') }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('img/placeholder.jpg') }}'">
        </div>

        <div class="product-info-box">

            <span id="detailsCategory" class="product-category" style="color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">{{ $product->category->name ?? 'Unknown Category' }}</span>

            <h1 id="detailsName" style="margin-top: 10px; margin-bottom: 15px; font-size: 2rem; color: #333;">{{ $product->name }}</h1>

            <p id="detailsDescription" class="product-description" style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                {{ $product->description ?: 'No description available for this product.' }}
            </p>

            <div class="product-price-area" style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px;">
                @php
                    $finalPrice = $product->price;
                    if ($product->has_offer && $product->offer_value > 0) {
                        $finalPrice = max(0, $product->price - $product->offer_value);
                    }
                @endphp
                
                @if($product->has_offer && $product->offer_value > 0)
                    <span id="detailsOldPrice" class="old-price" style="text-decoration: line-through; color: #999; font-size: 1.2rem;">{{ number_format($product->price, 2) }} EGP</span>
                @endif
                <span id="detailsPrice" class="new-price" style="font-weight: bold; color: #24B1B1; font-size: 1.8rem;">{{ number_format($finalPrice, 2) }} EGP</span>
            </div>

            <div id="detailsStatus" class="product-status" style="margin-bottom:20px; font-weight:bold; font-size: 1.1rem; color: {{ $product->status === 'available' ? '#4CAF50' : '#F44336' }}">
                {{ $product->status === 'available' ? 'In Stock' : 'Out of Stock' }}
            </div>

            @if($product->status === 'available' && $product->quantity > 0)
                <button id="addCartBtn" class="product-btn" onclick="addToCart({{ $product->product_id }})" style="width: 100%; padding: 15px; background-color: #24B1B1; color: white; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; transition: background 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                    Add To Cart
                </button>
            @else
                <button class="product-btn" onclick="openRequestModal({{ $product->product_id }})" style="width: 100%; padding: 15px; background-color: #ff9800; color: white; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; transition: background 0.3s;">
                    Request Stock
                </button>
            @endif

        </div>

    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="related-products">
    <div class="container">
        <h2 class="section-title">Alternative Products</h2>
        <div class="products-grid" id="relatedProducts">
            @foreach($relatedProducts as $related)
                @include('partials.product-card', ['product' => $related])
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadCart();
    });
</script>
@endsection