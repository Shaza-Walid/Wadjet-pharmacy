<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Services\Supplier\SupplierService;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    public function __construct(
        protected readonly SupplierService $supplierService
    ) {}

    public function index()
    {
        $suppliers = $this->supplierService->getAllSuppliers();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function store(StoreSupplierRequest $request)
    {
        $this->supplierService->createSupplier($request->validated());

        return redirect()->back()->with('success', 'Supplier created successfully');
    }

    public function update(UpdateSupplierRequest $request, string $id)
    {
        $supplier = $this->supplierService->updateSupplier($id, $request->validated());

        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found');
        }

        return redirect()->back()->with('success', 'Supplier updated successfully');
    }

    public function destroy(string $id)
    {
        try {
            $this->supplierService->deleteSupplier($id);
            return redirect()->back()->with('success', 'Supplier deleted successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->validator->errors()->first());
        }
    }
}