<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\CreateCategoryAction;
use App\Actions\DeleteCategoryAction;
use App\Actions\UpdateCategoryAction;
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
        return view('dashboard.admin.categories.index', [
            'categories' => Category::getCategories()->get(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.admin.categories.create');
    }

    public function store(StoreCategoryRequest $request, CreateCategoryAction $action): RedirectResponse
    {

        $action->handle(CategoryDTO::fromArray($request->validated()));

        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully!');
    }

    public function show(Category $category): View
    {
        return view('dashboard.admin.categories.show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category): View
    {
        return view('dashboard.admin.categories.update', [
            'category' => $category,
        ]);
    }

    public function update(StoreCategoryRequest $request, Category $category, UpdateCategoryAction $action): RedirectResponse
    {
        $action->handle(CategoryDTO::fromArray($request->validated()), $category);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully!');
    }

    public function destroy(Category $category, DeleteCategoryAction $action): RedirectResponse
    {
        $action->handle($category);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category Deleted successfully!');
    }
}
