<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Laravel\Scout\Searchable;

/**
 * App\Models\Asset
 *
 * @property-read \App\Models\AssignedUser|null $assignedUser
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Image|null $image
 *
 * @method static \Database\Factories\AssetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Asset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset query()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Asset withoutTrashed()
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int|null $assigned_user_id
 * @property int|null $image_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereAssignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asset whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AssetComponent> $assetComponent
 * @property-read int|null $asset_component_count
 *
 * @mixin \Eloquent
 */
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

    public function assetComponent(): HasMany
    {
        return $this->hasMany(AssetComponent::class);
    }

    public static function getAssetWithCategory()
    {
        $asset = Asset::find(1)->select('category_id')->with('category')->get();
        Log::info($asset);

        $asset = Asset::find(1)->select('category_id')->get();
        $category = $asset->category()->get();
        Log::info($category::class);
        Log::info($category);

        return $asset;
    }
}
