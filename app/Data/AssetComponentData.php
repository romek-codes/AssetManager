<?php

namespace App\Data;

use App\Models\AssetComponent;
use Spatie\LaravelData\Data;

class AssetComponentData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public CategoryData|null $category,
        public AssignedUserData|null $assignedUser,
        public ImageData|null $image,
    ) {
    }

    public static function fromModel(AssetComponent $assetComponent): self
    {
        return new self(
            $assetComponent->id,
            $assetComponent->name,
            CategoryData::optional($assetComponent->category),
            AssignedUserData::optional($assetComponent->assignedUser),
            ImageData::optional($assetComponent->image),
        );
    }
}
