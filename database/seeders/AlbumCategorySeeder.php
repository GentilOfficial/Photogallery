<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumCategory;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->pluck('id');
        foreach (Album::all() as $album) {
            $shuffledCategories = $categories->shuffle()->toArray();

            AlbumCategory::create([
                'album_id' => $album->id,
                'category_id' => $shuffledCategories[0]
            ]);

            AlbumCategory::create([
                'album_id' => $album->id,
                'category_id' => $shuffledCategories[1]
            ]);

            AlbumCategory::create([
                'album_id' => $album->id,
                'category_id' => $shuffledCategories[2]
            ]);
        }
    }
}
