<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function getAllCategories(): JsonResponse
    {
        $categories = $this->categoryService->getAllCategories(auth()->id());
        return response()->json($categories);
    }

    public function createCategory(CreateCategoryRequest $request): JsonResponse 
    {
        $category = $this->categoryService->createCategory($request->validated(), auth()->id());
        return response()->json($category, 201);
        
    }

    public function showCategory(Category $category): JsonResponse
    {
        return response()->json($category);
    }


    public function updateCategory(UpdateCategoryRequest $request, Category $category)
    {
        $category = $this->categoryService->updateCategory($category, $request->validated());
        return response()->json($category);
    }

    public function deleteCategory(Category $category): JsonResponse
    {
        $this->categoryService->deleteCategory($category);
        return response()->json(null, 204);
    }

    public function restore($categoryId): JsonResponse
    {
        $category = $this->categoryService->restoreCategory($categoryId);
        $this->authorize('restore', $category);
        return response()->json($category);
    }
}
