<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ImageData extends Data
{
    public function __construct(
        public string $name,
        public string $url
    ) {
    }
}
