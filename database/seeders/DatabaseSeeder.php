<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumCategory;
use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
// use Database\Seeders\UserSeeder;
// use Database\Seeders\AlbumSeeder;
// use Database\Seeders\PhotoSeeder;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");

        AlbumCategory::truncate();
        Category::truncate();
        User::truncate();
        Photo::truncate();
        Album::truncate();


        User::factory(count: 5)->has(
            Album::factory(count: 5)->has(
                Photo::factory(10)
            )
        )->create();

        $this->call(CategorySeeder::class);
        $this->call(AlbumCategorySeeder::class);
    }
}
