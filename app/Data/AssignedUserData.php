<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AssignedUserData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName
    ) {
    }
}
