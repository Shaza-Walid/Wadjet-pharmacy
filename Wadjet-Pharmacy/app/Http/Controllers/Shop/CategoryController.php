<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected readonly CategoryService $categoryService
    ) {}

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json(['success' => true, 'data' => $categories]);
    }

    public function show(string $id)
    {
        $category = $this->categoryService->getCategory($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // Placeholder for shop category view
        return view('pages.shop.category', compact('category')); 
    }
}