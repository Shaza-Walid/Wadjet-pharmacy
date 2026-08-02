@extends('layouts.app')

@section('title', 'Customer Dashboard - Wedjed Pharmacy')

@section('styles')
<style>
    .dashboard-wrapper {
        background-color: #f4f7f6;
        padding: 60px 20px;
        min-height: calc(100vh - 300px);
        font-family: 'Cairo', sans-serif;
    }
    .dashboard-container {
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
    }
    @media (max-width: 768px) {
        .dashboard-container {
            grid-template-columns: 1fr;
        }
    }
    
    /* Profile Card */
    .profile-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 120px;
        background: linear-gradient(135deg, #007979, #005a5a);
        z-index: 1;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        background: #fff;
        border-radius: 50%;
        margin: 0 auto 20px;
        position: relative;
        z-index: 2;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 800;
        color: #007979;
        margin-top: 40px;
    }
    .profile-name {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    .profile-role {
        font-size: 14px;
        color: #7f8c8d;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 25px;
    }
    .logout-btn {
        background: #fff;
        color: #dc3545;
        border: 2px solid #dc3545;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .logout-btn:hover {
        background: #dc3545;
        color: #fff;
    }

    /* Details Section */
    .details-section {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    .info-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 30px;
    }
    .info-card h3 {
        font-size: 20px;
        color: #2c3e50;
        margin-bottom: 25px;
        border-bottom: 2px solid #f0f2f5;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    @media (max-width: 500px) {
        .info-grid { grid-template-columns: 1fr; }
    }
    .info-item {
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: 12px;
        border-left: 4px solid #007979;
    }
    .info-label {
        font-size: 13px;
        color: #7f8c8d;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        font-size: 16px;
        color: #2c3e50;
        font-weight: 600;
    }
    
    /* Alert */
    .custom-alert {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        border-left: 4px solid #2e7d32;
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    
    @if(session('success'))
        <div style="max-width: 1000px; margin: 0 auto;">
            <div class="custom-alert">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="dashboard-container">
        <!-- Left Sidebar (Profile) -->
        <div class="profile-card">
            @php
                $name = Auth::guard('web')->user()->name;
                $initial = strtoupper(substr($name, 0, 1));
            @endphp
            <div class="profile-avatar">
                {{ $initial }}
            </div>
            <div class="profile-name">{{ $name }}</div>
            <div class="profile-role">Verified Customer</div>

            <form action="{{ route('customers.logout') }}" method="POST" style="margin-top: 30px;">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </button>
            </form>
        </div>

        <!-- Right Content -->
        <div class="details-section">
            
            <!-- Personal Info -->
            <div class="info-card">
                <h3>
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#007979" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Personal Information
                </h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ Auth::guard('web')->user()->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ Auth::guard('web')->user()->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">{{ Auth::guard('web')->user()->phone }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Account ID</div>
                        <div class="info-value">#{{ str_pad(Auth::guard('web')->user()->customer_id ?? Auth::guard('web')->user()->id, 4, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <div class="info-label">Delivery Address</div>
                        <div class="info-value">{{ Auth::guard('web')->user()->address ?? 'No address provided' }}</div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Placeholder -->
            <div class="info-card">
                <h3>
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#007979" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    Recent Activity
                </h3>
                <div style="text-align: center; padding: 40px 20px; color: #7f8c8d;">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="#bdc3c7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 15px;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    <p style="font-size: 16px;">You don't have any recent orders yet.</p>
                    <a href="{{ route('products.index') }}" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: #007979; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">Browse Products</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection