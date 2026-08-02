<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Services\Customer\CustomerService;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function __construct(
        protected readonly CustomerService $customerService
    ) {}

    public function index()
    {
        $customers = $this->customerService->getAllCustomers();

        return view('admin.customers.index', compact('customers'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->createCustomer($request->validated());

        return redirect()->back()->with('success', 'Customer created successfully');
    }

    public function show(string $id)
    {
        $customer = $this->customerService->getCustomer($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        return view('admin.'.strtolower(class_basename($this)).'.view', compact('customer')); // Refactored placeholder
    }

    public function update(UpdateCustomerRequest $request, string $id)
    {
        $customer = $this->customerService->updateCustomer($id, $request->validated());

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        return redirect()->back()->with('success', 'Customer updated successfully');
    }

    public function destroy(string $id)
    {
        try {
            $this->customerService->deleteCustomer($id);
            return redirect()->back()->with('success', 'Customer deleted successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->validator->errors()->first());
        }
    }
}