<?php

namespace App\Data;

use App\Models\Asset;
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

    public static function fromModel(Asset $asset): self
    {
        return new self(
            $asset->id,
            $asset->name,
            CategoryData::fromModel($asset->category),
            AssignedUserData::optional($asset->assignedUser),
            ImageData::optional($asset->image)
        );
    }
}
