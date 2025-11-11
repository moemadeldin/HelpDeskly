<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\DTOs\Admin\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::getCategories()->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('dashboard.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $dto = CategoryDTO::fromArray($request->validated());
        Category::create($dto->toArray());

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function show(Category $category): View
    {
        return view('dashboard.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('dashboard.categories.update', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        $dto = CategoryDTO::fromArray($request->validated());
        $category->update($dto->toArray());

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Deleted successfully!');
    }
}
