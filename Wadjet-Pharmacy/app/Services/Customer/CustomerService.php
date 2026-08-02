<?php

namespace App\Services\Customer;

use App\Models\Customer;
use Illuminate\Validation\ValidationException;

class CustomerService
{
    public function getAllCustomers()
    {
        return Customer::get();
    }

    public function getCustomer(string $id)
    {
        return Customer::find($id);
    }

    public function createCustomer(array $data)
    {
        return Customer::create($data);
    }

    public function updateCustomer(string $id, array $data)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return null;
        }

        $customer->update($data);
        return $customer;
    }

    public function deleteCustomer(string $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            throw ValidationException::withMessages(['error' => 'Customer not found']);
        }

        $customer->delete();
    }
}
