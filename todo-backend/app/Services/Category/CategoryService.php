<?php

namespace App\Services\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAllCategories(int $userId): Collection
    {
        return Category::where('user_id', $userId)->get();
    }

    public function createCategory(array $data, int $userId): Category
    {
        $data['user_id'] = $userId;
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);
        return $category->fresh();
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }

    public function restoreCategory(int $categoryId): ?Category
    {
        $category = Category::withTrashed()->findOrFail($categoryId);
        $category->restore();
        return $category;
    }

    public function getAllDeletedCategories(int $userId): Collection
    {
        return Category::onlyTrashed()->where('user_id', $userId)->get();
    }
}