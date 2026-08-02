<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::all();
    }
    public function getCategory(string $id)
    {
        return Category::find($id);
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(string $id, array $data)
    {
        $category = Category::find($id);

        if (!$category) {
            return null;
        }

        $category->update($data);
        return $category;
    }

    public function deleteCategory(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            throw ValidationException::withMessages(['error' => 'Category not found']);
        }

        if ($category->products()->exists()) {
            throw ValidationException::withMessages(['error' => 'Cannot delete category with existing products']);
        }

        $category->delete();
    }
}
