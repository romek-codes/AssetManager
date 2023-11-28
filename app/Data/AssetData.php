<?php

namespace App\Data;

use App\Models\Asset;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class AssetData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public CategoryData|null $category,
        public AssignedUserData|null $assignedUser,
        public ImageData|null $image,
        /** @var array<AssetComponentData>|null $assetComponents */
        public Collection|null $assetComponents,
    ) {
    }

    public static function fromModel(Asset $asset): self
    {
        $assetComponents = $asset->assetComponent->map(function ($assetComponent) {
            return AssetComponentData::fromModel($assetComponent);
        });

        return new self(
            $asset->id,
            $asset->name,
            CategoryData::optional($asset->category),
            AssignedUserData::optional($asset->assignedUser),
            ImageData::optional($asset->image),
            $assetComponents
        );
    }
}
