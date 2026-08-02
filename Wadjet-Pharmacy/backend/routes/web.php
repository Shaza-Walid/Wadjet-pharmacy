<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AvailabilityRequestController as AdminAvailabilityRequestController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OrderItemController as AdminOrderItemController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SupplierController as AdminSupplierController;

use App\Http\Controllers\Shop\AvailabilityRequestController as ShopAvailabilityRequestController;
use App\Http\Controllers\Shop\CategoryController as ShopCategoryController;
use App\Http\Controllers\Shop\ContactController;
use App\Http\Controllers\Shop\CustomerAuthController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\OrderController as ShopOrderController;
use App\Http\Controllers\Shop\ProductController as ShopProductController;
use App\Http\Controllers\Shop\SupplierController as ShopSupplierController;

use Illuminate\Support\Facades\Route;

// ==== View Routes ====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('register');

// ==== Public Action Routes ====
Route::get('/products', [ShopProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ShopProductController::class, 'show'])->name('products.show');
Route::get('/categories', [ShopCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [ShopCategoryController::class, 'show'])->name('categories.show');
Route::get('/suppliers', [ShopSupplierController::class, 'index'])->name('suppliers.index');
Route::get('/suppliers/{id}', [ShopSupplierController::class, 'show'])->name('suppliers.show');

Route::post('/orders', [ShopOrderController::class, 'store'])->name('orders.store');
Route::post('/availability-requests', [ShopAvailabilityRequestController::class, 'store'])->name('availability-requests.store');
Route::post('/customers/register', [CustomerAuthController::class, 'register'])->name('customers.register.submit');
Route::post('/customers/login', [CustomerAuthController::class, 'login'])->name('customers.login.submit');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Logout routes (we need GET or POST for MVC)
Route::post('/customers/logout', [CustomerAuthController::class, 'logout'])->name('customers.logout');
Route::post('/admins/logout', [AdminAuthController::class, 'logout'])->name('admins.logout');


// ==== Authenticated Customer Routes ====
Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', function () { return view('pages.customer.dashboard'); })->name('dashboard');
    // Add customer specific routes here if needed
});

// ==== Admin Only Routes ====
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/suppliers', [AdminSupplierController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers', [AdminSupplierController::class, 'store'])->name('suppliers.store');
    Route::put('/suppliers/{id}', [AdminSupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{id}', [AdminSupplierController::class, 'destroy'])->name('suppliers.destroy');

    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [AdminCustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');
    Route::put('/customers/{id}', [AdminCustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [AdminCustomerController::class, 'destroy'])->name('customers.destroy');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/order-items', [AdminOrderItemController::class, 'index'])->name('order-items.index');
    Route::post('/order-items', [AdminOrderItemController::class, 'store'])->name('order-items.store');
    Route::get('/order-items/{id}', [AdminOrderItemController::class, 'show'])->name('order-items.show');
    Route::put('/order-items/{id}', [AdminOrderItemController::class, 'update'])->name('order-items.update');
    Route::delete('/order-items/{id}', [AdminOrderItemController::class, 'destroy'])->name('order-items.destroy');

    Route::get('/availability-requests', [AdminAvailabilityRequestController::class, 'index'])->name('availability-requests.index');
    Route::put('/availability-requests/{id}/status', [AdminAvailabilityRequestController::class, 'updateStatus'])->name('availability-requests.updateStatus');
    Route::delete('/availability-requests/{id}', [AdminAvailabilityRequestController::class, 'destroy'])->name('availability-requests.destroy');

    Route::get('/admins', [AdminAuthController::class, 'index'])->name('admins.index');
    Route::post('/admins', [AdminAuthController::class, 'store'])->name('admins.store');
    Route::delete('/admins/{id}', [AdminAuthController::class, 'destroy'])->name('admins.destroy');
});
