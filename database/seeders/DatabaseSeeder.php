<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Asset;
use App\Models\AssetComponent;
use App\Models\AssignedUser;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::truncate();
        AssignedUser::truncate();
        Image::truncate();
        Asset::truncate();
        AssetComponent::truncate();

        Category::factory()->count(10)->create();
        AssignedUser::factory()->count(10)->create();
        Image::factory()->count(10)->create();
        Asset::factory()->count(50)->create();
        AssetComponent::factory()->count(50)->create();
    }
}
