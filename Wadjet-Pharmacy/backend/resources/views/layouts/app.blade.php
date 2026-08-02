<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wedjed Pharmacy - Home')</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=2') }}">
    @yield('styles')
</head>
<body>

    <!-- ========== HEADER ========== -->
    <header class="header">
        <div class="header-container">
            <div class="logo-section">
                <a href="{{ route('home') }}" class="logo-link">
                    <img src="{{ asset('img/logo (2).png') }}" alt="Wedjed" class="logo-icon" onerror="this.style.display='none'">
                    <img src="{{ asset('img/logo3.png') }}" alt="Wedjed Pharmacy" class="logo-text-img" onerror="this.style.display='none'">
                </a>
            </div>

            <nav>
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                </ul>
            </nav>

            <div class="header-icons">
                @if(Auth::guard('admin')->check())
                    <button class="icon-btn" onclick="window.location.href='{{ route('admin.orders.index') }}'" title="Admin Dashboard">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </button>
                @elseif(Auth::guard('web')->check())
                    <button class="icon-btn" onclick="window.location.href='{{ route('dashboard') }}'" title="Customer Dashboard">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                @else
                    <button class="icon-btn" onclick="window.location.href='{{ route('login') }}'" title="Log In">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                    </button>
                @endif
                <button class="icon-btn" onclick="showCart()" title="Cart">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                    <span class="cart-count" id="cartCount">0</span>
                </button>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="footer-top-wave">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V0H1380C1320 0 1200 0 1080 0C960 0 840 0 720 0C600 0 480 0 360 0C240 0 120 0 60 0H0V120Z" fill="#007979"/>
            </svg>
        </div>
        <div class="footer-container">
            <!-- Brand Column -->
            <div class="footer-section footer-brand">
                <div class="footer-brand-header">
                    <img src="{{ asset('img/logo-2.png') }}" alt="Wedjed Pharmacy" class="footer-logo-img" onerror="this.style.display='none'">
                    <h3>Wedjed Pharmacy</h3>
                </div>
                <p class="footer-desc">Comprehensive healthcare that meets all your health needs with the highest standards of quality and safety.</p>
                <div class="footer-social">
                    <a href="#" class="social-icon" title="Facebook">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <a href="#" class="social-icon" title="Instagram">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="social-icon" title="WhatsApp">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><span>&rsaquo;</span> Home</a></li>
                    <li><a href="{{ route('products.index') }}"><span>&rsaquo;</span> Products</a></li>
                    <li><a href="{{ route('about') }}"><span>&rsaquo;</span> About Us</a></li>
                </ul>
            </div>

            <!-- Working Hours -->
            <div class="footer-section footer-hours">
                <h4>Working Hours</h4>
                <ul>
                    <li>
                        <span class="day">Sat - Thu</span>
                        <span class="time">8:00 AM - 12:00 AM</span>
                    </li>
                    <li>
                        <span class="day">Friday</span>
                        <span class="time">4:00 PM - 12:00 AM</span>
                    </li>
                    <li>
                        <span class="day emergency">Emergency</span>
                        <span class="time emergency">24 Hours</span>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-section footer-contact">
                <h4>Contact Us</h4>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <div class="contact-text">
                        <span class="contact-label">Phone</span>
                        <a href="tel:+20101234567">+20 10 123 4567</a>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6" stroke="#fff" fill="none"/></svg>
                    </div>
                    <div class="contact-text">
                        <span class="contact-label">Email</span>
                        <a href="mailto:info@wedjed-pharmacy.com">info@wedjed-pharmacy.com</a>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3" fill="#fff"/></svg>
                    </div>
                    <div class="contact-text">
                        <span class="contact-label">Location</span>
                        <span>Cairo, Egypt</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2026 Wedjed Pharmacy - All Rights Reserved</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <span>|</span>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========== REQUEST MODAL ========== -->
    <div class="modal-overlay" id="requestModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" width="60" height="60" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </div>
            <h3 class="modal-title">Request Product Availability</h3>
            <p class="modal-subtitle" id="modalProductName">We will notify you when available</p>
            <form class="modal-form" id="availabilityForm" onsubmit="handleRequestSubmit(event)">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="reqName" required placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" id="reqPhone" required placeholder="01xxxxxxxx">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" id="reqAddress" placeholder="Your address">
                </div>
                <div class="form-group">
                    <label>Notes (Optional)</label>
                    <textarea id="reqNotes" placeholder="Any additional notes..."></textarea>
                </div>
                <button type="submit" class="modal-submit">Send Request</button>
            </form>
        </div>
    </div>

    <!-- ========== TOAST ========== -->
    <div class="toast" id="toast"></div>

    <!-- ========== JAVASCRIPT ========== -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/db.js?v=2') }}"></script>
    <script>
        // Override dummy DB data with real DB data for products to fix cart desync
        @php
            $dbProducts = \App\Models\Product::with('category')->get()->map(function($p) {
                return [
                    'product_id' => $p->product_id,
                    'category_id' => $p->category_id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => asset($p->image ?: 'img/placeholder.jpg'),
                    'price' => (float)$p->price,
                    'quantity' => (int)$p->quantity,
                    'status' => $p->status,
                    'has_offer' => $p->has_offer ? 1 : 0,
                    'offer_value' => (float)$p->offer_value,
                ];
            });
            $dbCategories = \App\Models\Category::all()->map(function($c) {
                return [
                    'category_id' => $c->category_id,
                    'name' => $c->name
                ];
            });
        @endphp
        products = {!! json_encode($dbProducts) !!};
        categories = {!! json_encode($dbCategories) !!};
    </script>
    <script src="{{ asset('js/api.js?v=2') }}"></script>
    <script src="{{ asset('js/main.js?v=2') }}"></script>
    @yield('scripts')
</body>
</html>
