<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AssetComponent
 *
 * @property-read \App\Models\Asset|null $asset
 * @property-read \App\Models\AssignedUser|null $assignedUser
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Image|null $image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent query()
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int $category_id
 * @property int|null $assigned_user_id
 * @property int|null $image_id
 * @property int|null $asset_id
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereAssignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetComponent whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AssetComponent extends Model
{
    use HasFactory;

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

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
