<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'album_name' => $this->faker->text(60),
            'album_thumb' => "https://loremflickr.com/640/480?lock=" . $this->faker->randomNumber(5, false),
            'description' => $this->faker->text(120),
            'user_id' => User::factory()
        ];
    }
}
