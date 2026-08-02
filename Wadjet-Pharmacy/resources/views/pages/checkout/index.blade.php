@extends('layouts.app')

@section('title', 'Checkout - Wedjed Pharmacy')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css?v=2') }}">

@endsection

@section('content')


    <!-- ========== CHECKOUT SECTION ========== -->
    <section class="checkout">
        <h1>Checkout</h1>
        <form id="checkoutForm">
            <input type="text" id="customerName" placeholder="Full Name" required>
            <input type="tel" id="customerPhone" placeholder="Phone Number" required>
            <textarea id="customerAddress" placeholder="Delivery Address" required></textarea>
            <textarea id="orderNotes" placeholder="Additional Notes (Optional)"></textarea>
            <h2>Total: <span id="checkoutTotal">0 EGP</span></h2>
            <button type="submit">Confirm Order</button>
        </form>
    </section>

    
@endsection

@section('scripts')
    <script src="{{ asset('js/checkout.js?v=2') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
        });
    </script>

@endsection