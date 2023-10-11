<?php

namespace App\Data;

use App\Models\AssignedUser;
use Spatie\LaravelData\Data;

class AssignedUserData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName
    ) {
    }

    public static function fromModel(AssignedUser $assignedUser): self
    {
        return new self(
            $assignedUser->first_name,
            $assignedUser->last_name
        );
    }
}
