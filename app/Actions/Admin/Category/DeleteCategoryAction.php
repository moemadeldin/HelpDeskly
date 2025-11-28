<?php

declare(strict_types=1);

namespace App\Actions\Admin\Category;

use App\Models\Category;

final readonly class DeleteCategoryAction
{
    public function handle(Category $category): void
    {
        $category->delete();
    }
}
