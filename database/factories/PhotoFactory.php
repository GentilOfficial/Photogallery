<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(60),
            'description' => $this->faker->text(128),
            'img_path' => "https://loremflickr.com/640/480?lock=" . $this->faker->randomNumber(5),
            'album_id' => Album::factory()
        ];
    }
}
