<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\CustomerLoginRequest;
use App\Http\Requests\Auth\CustomerRegisterRequest;
use App\Services\Auth\CustomerAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerAuthController extends Controller
{
    public function __construct(
        protected readonly CustomerAuthService $customerAuthService
    ) {}

    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function register(CustomerRegisterRequest $request)
    {
        $customer = $this->customerAuthService->register($request->validated());

        Auth::guard('web')->login($customer);

        return redirect()->route('dashboard')->with('success', 'Registration successful');
    }

    public function login(CustomerLoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.orders.index')->with('success', 'Welcome Admin');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully');
    }
}