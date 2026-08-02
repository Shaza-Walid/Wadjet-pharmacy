@extends('layouts.app')

@section('title', 'Login - Wedjed Pharmacy')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css?v=2') }}">
@endsection

@section('content')

    <!-- ========== LOGIN SECTION ========== -->
    <div class="login-container">
        <div class="login-card">
            <h1>Welcome Back</h1>
            <p>Login to your account</p>

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

            <form id="loginForm" method="POST" action="{{ route('customers.login.submit') }}">
                @csrf
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="password-box">
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        <span id="togglePassword">&#128065;</span>
                    </div>
                </div>

                <button type="submit">Login</button>
            </form>

            <div class="links">
                <a href="#">Forgot Password?</a>
            </div>

            <p class="register">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </p>

            <a href="{{ route('home') }}" class="back">&larr; Back To Home</a>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/login.js?v=2') }}"></script>
@endsection
