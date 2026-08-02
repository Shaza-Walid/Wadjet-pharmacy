@extends('layouts.app')

@section('title', 'Shopping Cart - Wedjed Pharmacy')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css?v=2') }}">

@endsection

@section('content')

    <!-- ========== CART PAGE ========== -->
    <section class="cart-page">
        <div class="cart-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="margin-bottom: 5px; display: flex; align-items: center; gap: 10px;">
                    <svg viewBox="0 0 24 24" width="36" height="36"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    Shopping Cart
                </h1>
                <p class="cart-subtitle" style="margin: 0;">Review your items and proceed to checkout</p>
            </div>
            <button onclick="clearCart()" class="btn btn-danger" style="background-color: #ef4444; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='#dc2626'" onmouseout="this.style.backgroundColor='#ef4444'">
                <svg viewBox="0 0 24 24" width="18" height="18" style="stroke: currentColor; fill: none; stroke-width: 2;"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                Clear Cart
            </button>
        </div>

        <div class="cart-layout">
            <!-- Cart Items Column -->
            <div class="cart-items-column">
                <div id="cartItems"></div>
            </div>

            <!-- Cart Summary Column -->
            <div class="cart-summary-column">
                <div class="cart-summary-card">
                    <h3>Order Summary</h3>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="summarySubtotal">0 EGP</span>
                    </div>

                    <div class="summary-row">
                        <span>Shipping</span>
                        <span id="summaryShipping" class="shipping-free">Free</span>
                    </div>

                    <div class="summary-row discount-row" id="discountRow" style="display: none;">
                        <span>Discount (20%)</span>
                        <span id="summaryDiscount">-0 EGP</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row total-row">
                        <span>Total</span>
                        <span id="summaryTotal">0 EGP</span>
                    </div>

                    <!-- Offer Progress -->
                    <div class="offer-progress" id="offerProgress">
                        <div class="progress-bar">
                            <div class="progress-fill" id="progressFill"></div>
                        </div>
                        <p id="progressText">Add <strong>1,000 EGP</strong> more to get 20% OFF!</p>
                    </div>

                    <button id="checkoutBtn" class="checkout-btn" onclick="goToCheckout()">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Proceed to Checkout
                    </button>

                    <a href="{{ route('products.index') }}" class="continue-shopping">
                        <svg viewBox="0 0 24 24" width="16" height="16"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </section>

    
@endsection

@section('scripts')
    <script src="{{ asset('js/cart.js?v=2') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
        });
    </script>

@endsection