<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\Admin\CategoryDTO;
use App\Models\Category;

final readonly class UpdateCategoryAction
{
    public function handle(CategoryDTO $dto, Category $category): Category
    {
        $category->update($dto->toArray());

        return $category;
    }
}
