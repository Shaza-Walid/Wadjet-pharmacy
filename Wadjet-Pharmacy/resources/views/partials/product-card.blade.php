<div class="product-card" onclick="window.location='{{ route('products.show', $product->product_id) }}'">
    <div class="product-image">
        @if($product->has_offer)
            <span class="offer-badge">Special Offer</span>
        @endif
        <img src="{{ asset($product->image ?: 'img/placeholder.jpg') }}" alt="{{ $product->name }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('img/placeholder.jpg') }}'">
        <span class="status-badge {{ $product->status }}">{{ $product->status === 'available' ? 'Available' : 'Out of Stock' }}</span>
    </div>
    
    <div class="product-info">
        <div class="product-category">{{ $product->category?->name ?? 'Unknown' }}</div>
        <h3 class="product-name">{{ $product->name }}</h3>
        
        @if($product->has_offer && $product->offer_value > 0)
            <div class="product-price">
                <span style="text-decoration: line-through; color: #999; font-size: 0.9rem;">{{ number_format($product->price, 2) }}</span>
                <span style="color: #24B1B1; font-weight: bold;">{{ number_format(max(0, $product->price - $product->offer_value), 2) }}</span>
                <span>EGP</span>
            </div>
        @else
            <div class="product-price">{{ number_format($product->price, 2) }} <span>EGP</span></div>
        @endif
        
        @if($product->status === 'available' && $product->quantity > 0)
            <button class="product-btn add-to-cart" onclick="event.stopPropagation(); addToCart({{ $product->product_id }})">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                Add to Cart
            </button>
        @else
            <button class="product-btn request-stock" onclick="event.stopPropagation(); openRequestModal({{ $product->product_id }})">
                Request Stock
            </button>
        @endif
    </div>
</div>
