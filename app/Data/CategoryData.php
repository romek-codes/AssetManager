<?php

namespace App\Data;

use App\Models\Category;
use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        public string $name
    ) {
    }

    public static function fromModel(Category $category): self
    {
        return new self(
            $category->name
        );
    }
}
