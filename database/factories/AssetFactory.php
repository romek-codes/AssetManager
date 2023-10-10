<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\AssignedUser;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'assigned_user_id' => AssignedUser::inRandomOrder()->first()->id,
            'image_id' => Image::inRandomOrder()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
