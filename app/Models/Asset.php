<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Laravel\Scout\Searchable;

class Asset extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(AssignedUser::class);
    }

    public static function getAssetWithCategory()
    {
        $asset = Asset::find(1)->select('category_id')->with('category')->get();
        Log::info($asset);

        $asset = Asset::find(1)->select('category_id')->get();
        $category = $asset->category()->get();
        Log::info(get_class($category));
        Log::info($category);

        return $asset;
    }
}
