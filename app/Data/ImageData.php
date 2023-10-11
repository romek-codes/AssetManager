<?php

namespace App\Data;

use App\Models\Image;
use Spatie\LaravelData\Data;

class ImageData extends Data
{
    public function __construct(
        public string $name,
        public string $url
    ) {
    }

    public static function fromModel(Image $image): self
    {
        return new self(
            $image->name,
            $image->url
        );
    }
}
