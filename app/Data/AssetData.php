<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AssetData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public CategoryData $category,
        public AssignedUserData|null $assignedUser,
        public ImageData|null $image
    ) {
    }
}
