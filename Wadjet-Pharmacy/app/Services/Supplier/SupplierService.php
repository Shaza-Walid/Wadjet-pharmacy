<?php

namespace App\Services\Supplier;

use App\Models\Supplier;
use Illuminate\Validation\ValidationException;

class SupplierService
{
    public function getAllSuppliers()
    {
        return Supplier::get();
    }

    public function getSupplier(string $id)
    {
        return Supplier::find($id);
    }

    public function createSupplier(array $data)
    {
        return Supplier::create($data);
    }

    public function updateSupplier(string $id, array $data)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return null;
        }

        $supplier->update($data);
        return $supplier;
    }

    public function deleteSupplier(string $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            throw ValidationException::withMessages(['error' => 'Supplier not found']);
        }

        if ($supplier->products()->exists()) {
            throw ValidationException::withMessages(['error' => 'Cannot delete supplier linked to existing products']);
        }

        $supplier->delete();
    }
}
