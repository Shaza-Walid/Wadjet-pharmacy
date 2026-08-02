@extends('layouts.app')

@section('title', 'Register - Wedjed Pharmacy')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css?v=2') }}">
@endsection

@section('content')
    <!-- ========== REGISTER SECTION ========== -->
    <div class="login-container">
        <div class="login-card">
            <h1>Create Account</h1>
            <p>Join Wedjed Pharmacy today</p>

            @if(session('error'))
                <div style="color: red; margin-bottom: 15px; text-align: center;">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div style="color: green; margin-bottom: 15px; text-align: center;">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div style="color: red; margin-bottom: 15px; text-align: center;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form id="registerForm" method="POST" action="{{ route('customers.register.submit') }}">
                @csrf
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="name" id="regName" placeholder="Enter your full name" required value="{{ old('name') }}">
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" id="regEmail" placeholder="Enter your email" required value="{{ old('email') }}">
                </div>

                <div class="input-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" id="regPhone" placeholder="01xxxxxxxx" required value="{{ old('phone') }}">
                </div>

                <div class="input-group">
                    <label>Address</label>
                    <input type="text" name="address" id="regAddress" placeholder="Your delivery address" required value="{{ old('address') }}">
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="password-box">
                        <input type="password" name="password" id="regPassword" placeholder="Enter your password (min 6 chars)" required minlength="6">
                        <span id="toggleRegPassword">&#128065;</span>
                    </div>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <div class="password-box">
                        <input type="password" name="password_confirmation" id="regConfirmPassword" placeholder="Confirm your password" required>
                    </div>
                </div>

                <button type="submit">Create Account</button>
            </form>

            <p class="register">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </p>

            <a href="{{ route('home') }}" class="back">&larr; Back To Home</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/register.js?v=2') }}"></script>
@endsection