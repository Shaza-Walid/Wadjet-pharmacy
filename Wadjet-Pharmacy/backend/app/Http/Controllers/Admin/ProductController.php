<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Product\ProductService;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function __construct(
        protected readonly ProductService $productService
    ) {}

    public function index(Request $request)
    {
        $products = $this->productService->filterProducts($request->search, $request->category);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->createProduct($request->validated(), $request->user()->id);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = $this->productService->updateProduct($id, $request->validated());

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(string $id)
    {
        try {
            $this->productService->deleteProduct($id);
            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
        } catch (ValidationException $e) {
            return redirect()->route('admin.products.index')->with('error', $e->validator->errors()->first());
        }
    }
}