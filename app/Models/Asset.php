<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasOne<Image>
     */
    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    /**
     * @return HasOne<Category>
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }

    /**
     * @return HasOne<AssignedUser>
     */
    public function assignedUser(): HasOne
    {
        return $this->hasOne(AssignedUser::class);
    }
}
