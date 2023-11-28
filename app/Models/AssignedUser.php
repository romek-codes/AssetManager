<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AssignedUser
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\AssignedUserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignedUser withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AssignedUser extends Model
{
    use HasFactory, SoftDeletes;
}
