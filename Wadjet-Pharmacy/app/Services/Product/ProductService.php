<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Validation\ValidationException;

class ProductService
{
    public function filterProducts(?string $search, ?string $category)
    {
        $query = Product::with('category');

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($category)) {
            $query->whereHas('category', function($q) use ($category) {
                $q->where('name', $category);
            });
        }

        return $query->get();
    }

    public function getProductWithRelated(string $id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return null;
        }

        $relatedProducts = Product::with('category')
                            ->where('category_id', $product->category_id)
                            ->where('product_id', '!=', $product->product_id)
                            ->take(4)
                            ->get();

        return [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ];
    }

    public function createProduct(array $data, $adminId)
    {
        $status = $data['quantity'] > 0 ? 'available' : 'out_of_stock';

        return Product::create(array_merge($data, [
            'admin_id' => $adminId,
            'status' => $status,
        ]));
    }

    public function updateProduct(string $id, array $data)
    {
        $product = Product::find($id);

        if (!$product) {
            return null;
        }

        $product->update($data);

        if (isset($data['quantity'])) {
            $product->status = $data['quantity'] > 0 ? 'available' : 'out_of_stock';
            $product->save();
        }

        return $product;
    }

    public function deleteProduct(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw ValidationException::withMessages(['error' => 'Product not found']);
        }

        if ($product->orderItems()->exists()) {
            throw ValidationException::withMessages(['error' => 'Cannot delete product linked to existing orders']);
        }

        $product->delete();
    }
}
