<?php

declare(strict_types=1);

namespace App\Actions\Admin\Category;

use App\DTOs\Admin\CategoryDTO;
use App\Models\Category;

final readonly class CreateCategoryAction
{
    public function handle(CategoryDTO $dto): Category
    {
        return Category::create($dto->toArray());
    }
}
