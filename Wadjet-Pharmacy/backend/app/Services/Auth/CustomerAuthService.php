<?php

namespace App\Services\Auth;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerAuthService
{
    public function register(array $data)
    {
        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => $data['password'],
        ]);

        return $customer;
    }

    public function login(array $data)
    {
        $customer = Customer::where('email', $data['email'])->first();

        if (!$customer || !Hash::check($data['password'], $customer->password)) {
            return false;
        }

        return $customer;
    }
}
