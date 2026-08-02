<?php

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

function adminToken(): string
{
    $admin = Admin::where('name', 'admin')->first();

    return $admin->createToken('test')->plainTextToken;
}

function customerToken(): string
{
    $customer = Customer::first();

    return $customer->createToken('test')->plainTextToken;
}

test('health check endpoint works', function () {
    $this->getJson('/api/test')
        ->assertSuccessful()
        ->assertJson(['message' => 'Wadjet API is working']);
});

test('admin can login with username', function () {
    $this->postJson('/api/admins/login', [
        'username' => 'admin',
        'password' => 'admin123',
    ])
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id', 'name', 'email', 'token']]);
});

test('admin can login with email', function () {
    $this->postJson('/api/admins/login', [
        'email' => 'admin@wadjet.com',
        'password' => 'admin123',
    ])
        ->assertSuccessful()
        ->assertJsonPath('success', true);
});

test('admin login rejects invalid credentials', function () {
    $this->postJson('/api/admins/login', [
        'username' => 'admin',
        'password' => 'wrong-password',
    ])->assertUnauthorized();
});

test('customer can register and login', function () {
    $this->postJson('/api/customers/register', [
        'name' => 'Test Customer',
        'email' => 'test.customer@example.com',
        'phone' => '01012345678',
        'address' => 'Cairo, Egypt',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['token']]);

    $this->postJson('/api/customers/login', [
        'email' => 'test.customer@example.com',
        'password' => 'password123',
    ])
        ->assertSuccessful()
        ->assertJsonPath('success', true);
});

test('public products index returns seeded products', function () {
    $response = $this->getJson('/api/products');

    $response->assertSuccessful()
        ->assertJsonPath('success', true);

    expect($response->json('data'))->toBeArray()->not->toBeEmpty();
});

test('public product show returns product with category', function () {
    $product = Product::first();

    $this->getJson("/api/products/{$product->product_id}")
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.product_id', $product->product_id);
});

test('public categories and suppliers endpoints work', function () {
    $this->getJson('/api/categories')->assertSuccessful()->assertJsonPath('success', true);
    $this->getJson('/api/suppliers')->assertSuccessful()->assertJsonPath('success', true);
});

test('customer token cannot access admin routes', function () {
    $token = customerToken();

    $this->withToken($token)->getJson('/api/orders')->assertForbidden();
    $this->withToken($token)->postJson('/api/products', [
        'category_id' => 1,
        'name' => 'Blocked Product',
        'price' => 10,
        'quantity' => 5,
    ])->assertForbidden();
});

test('unauthenticated requests cannot access admin routes', function () {
    $this->getJson('/api/orders')->assertUnauthorized();
});

test('admin can manage products categories suppliers customers and orders', function () {
    $token = adminToken();

    $this->withToken($token)->postJson('/api/products', [
        'category_id' => 1,
        'supplier_id' => 1,
        'name' => 'API Test Product',
        'description' => 'Created in test',
        'price' => 25.50,
        'quantity' => 10,
    ])->assertCreated()->assertJsonPath('success', true);

    $productId = Product::where('name', 'API Test Product')->value('product_id');

    $this->withToken($token)->putJson("/api/products/{$productId}", [
        'price' => 30,
    ])->assertSuccessful();

    $this->withToken($token)->postJson('/api/categories', [
        'name' => 'Test Category',
        'description' => 'Test',
    ])->assertCreated();

    $this->withToken($token)->postJson('/api/suppliers', [
        'name' => 'Test Supplier',
        'email' => 'supplier@test.com',
    ])->assertCreated();

    $this->withToken($token)->getJson('/api/customers')->assertSuccessful();
    $this->withToken($token)->getJson('/api/orders')->assertSuccessful();
    $this->withToken($token)->getJson('/api/order-items')->assertSuccessful();
    $this->withToken($token)->getJson('/api/availability-requests')->assertSuccessful();
    $this->withToken($token)->getJson('/api/admins')->assertSuccessful();
});

test('guest can place order and create availability request', function () {
    $product = Product::where('quantity', '>', 1)->first();

    $this->postJson('/api/orders', [
        'customer_name' => 'Guest User',
        'phone' => '01099998888',
        'address' => 'Alexandria',
        'items' => [
            ['product_id' => $product->product_id, 'quantity' => 1],
        ],
    ])
        ->assertCreated()
        ->assertJsonPath('success', true);

    $this->postJson('/api/availability-requests', [
        'product_name' => 'Custom Medicine',
        'customer_name' => 'Guest User',
        'phone' => '01099998888',
    ])
        ->assertCreated()
        ->assertJsonPath('success', true);
});

test('order rejects insufficient stock with validation error', function () {
    $product = Product::first();
    $product->update(['quantity' => 1]);

    $this->postJson('/api/orders', [
        'customer_name' => 'Guest User',
        'phone' => '01099998888',
        'address' => 'Alexandria',
        'items' => [
            ['product_id' => $product->product_id, 'quantity' => 99],
        ],
    ])->assertUnprocessable();
});

test('admin can update order and availability request status', function () {
    $token = adminToken();
    $order = \App\Models\Order::first();

    $this->withToken($token)->putJson("/api/orders/{$order->order_id}/status", [
        'status' => 'delivered',
    ])->assertSuccessful();

    $request = \App\Models\AvailabilityRequest::first();

    $this->withToken($token)->putJson("/api/availability-requests/{$request->request_id}/status", [
        'status' => 'fulfilled',
    ])->assertSuccessful();
});

test('contact endpoint accepts valid payload', function () {
    $this->postJson('/api/contact', [
        'name' => 'Visitor',
        'email' => 'visitor@example.com',
        'phone' => '01011112222',
        'message' => 'Hello pharmacy',
    ])->assertCreated()->assertJsonPath('success', true);
});

test('admin cannot delete product linked to orders', function () {
    $token = adminToken();
    $productId = \App\Models\OrderItem::first()->product_id;

    $this->withToken($token)->deleteJson("/api/products/{$productId}")
        ->assertUnprocessable()
        ->assertJsonPath('success', false);
});

test('admin cannot delete category with products', function () {
    $token = adminToken();

    $this->withToken($token)->deleteJson('/api/categories/1')
        ->assertUnprocessable()
        ->assertJsonPath('success', false);
});

test('admin can manage order items and suppliers', function () {
    $token = adminToken();
    $order = \App\Models\Order::first();
    $product = Product::where('quantity', '>', 0)->first();

    $this->withToken($token)->postJson('/api/order-items', [
        'order_id' => $order->order_id,
        'product_id' => $product->product_id,
        'quantity' => 1,
        'unit_price' => 10.00,
    ])->assertCreated();

    $itemId = \App\Models\OrderItem::latest('item_id')->value('item_id');

    $this->withToken($token)->getJson("/api/order-items/{$itemId}")->assertSuccessful();
    $this->withToken($token)->putJson("/api/order-items/{$itemId}", [
        'quantity' => 2,
    ])->assertSuccessful();

    $supplierId = \App\Models\Supplier::first()->id;

    $this->withToken($token)->putJson("/api/suppliers/{$supplierId}", [
        'phone' => '01000000000',
    ])->assertSuccessful();
});

test('seeded customer can login', function () {
    $this->postJson('/api/customers/login', [
        'email' => 'yasmin.hassan@gmail.com',
        'password' => 'password123',
    ])
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['token']]);
});
