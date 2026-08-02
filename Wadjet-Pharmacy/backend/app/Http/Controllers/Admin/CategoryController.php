<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function __construct(
        protected readonly CategoryService $categoryService
    ) {}

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());

        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = $this->categoryService->updateCategory($id, $request->validated());

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function destroy(string $id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            return redirect()->back()->with('success', 'Category deleted successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->validator->errors()->first());
        }
    }
}