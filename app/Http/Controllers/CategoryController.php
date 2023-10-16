<?php

namespace App\Http\Controllers;

use App\Data\CategoryData;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::get()->map(function ($category) {
            return CategoryData::fromModel($category);
        });

        return Inertia::render(
            'Categories',
            [
                'categories' => $categories,
            ]
        );
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        return new CategoryResource(Category::create($requestData));
    }

    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category): CategoryResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        $category->update($requestData);

        return new CategoryResource($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json();
    }
}
