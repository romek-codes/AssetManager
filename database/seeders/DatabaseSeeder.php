<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Asset;
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
        Category::factory()->count(10)->create();
        AssignedUser::factory()->count(10)->create();
        Image::factory()->count(10)->create();
        Asset::factory()->count(50)->create();
    }
}
