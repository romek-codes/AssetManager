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
            'name' => $this->faker->word(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'assigned_user_id' => rand(0, 1) ? AssignedUser::inRandomOrder()->first()->id : null,
            'image_id' => rand(0, 1) ? Image::inRandomOrder()->first()->id : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
