@extends('layouts.app')

@section('title', 'About Us | Wedjed Pharmacy')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css?v=2') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

@endsection

@section('content')


    <!-- ========== ABOUT HERO ========== -->
    <section class="about-hero">
        <div class="hero-content">
            <span class="sub-title">Welcome To</span>
            <h1>Wedjed Pharmacy</h1>
            <p>
                At Wedjed, we believe that healthy skin begins with trusted care.
                Our mission is to provide premium skincare, haircare, body care, and baby care
                products from the world's most trusted brands while delivering exceptional
                customer service every day.
            </p>
            <a href="{{ route('products.index') }}" class="hero-btn">Shop Now</a>
        </div>
        <div class="hero-image">
            <img src="img/about.jpeg" alt="About Wedjed Pharmacy">
        </div>
    </section>

    
@endsection

@section('scripts')
    <script src="{{ asset('js/about.js?v=2') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
        });
    </script>

@endsection