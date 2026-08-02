<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Services\Supplier\SupplierService;

class SupplierController extends Controller
{
    public function __construct(
        protected readonly SupplierService $supplierService
    ) {}

    public function index()
    {
        $suppliers = $this->supplierService->getAllSuppliers();
        return response()->json(['success' => true, 'data' => $suppliers]);
    }

    public function show(string $id)
    {
        $supplier = $this->supplierService->getSupplier($id);

        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found');
        }

        return view('pages.shop.supplier', compact('supplier')); // Placeholder for shop supplier view
    }
}