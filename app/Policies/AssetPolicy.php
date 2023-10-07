<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Asset $asset): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Asset $asset): bool
    {
        return true;
    }

    public function delete(User $user, Asset $asset): bool
    {
        return true;
    }

    public function restore(User $user, Asset $asset): bool
    {
        return true;
    }

    public function forceDelete(User $user, Asset $asset): bool
    {
        return true;
    }
}
