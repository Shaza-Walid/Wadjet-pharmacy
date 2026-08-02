<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected readonly ProductService $productService
    ) {}

    public function index(Request $request)
    {
        $products = $this->productService->filterProducts($request->search, $request->category);
        $categories = Category::all();
        
        $currentCategory = $request->category ?: 'All';
        $searchQuery = $request->search;

        return view('pages.shop.index', compact('products', 'categories', 'currentCategory', 'searchQuery'));
    }

    public function show(string $id)
    {
        $data = $this->productService->getProductWithRelated($id);

        if (!$data) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }

        return view('pages.shop.product', [
            'product' => $data['product'],
            'relatedProducts' => $data['relatedProducts']
        ]);
    }
}