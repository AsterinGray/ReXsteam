<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'image_preview' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1172470/header.jpg?t=1621457566',
            'trailer_video' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/256832561/movie480_vp9.webm?t=1619624593',
            'description' => $this->faker->paragraph(2),
            'long_description' => $this->faker->paragraph(),
            'genre_id' => $this->faker->numberBetween(1, 10),
            'release_date' => $this->faker->date(),
            'developer' => $this->faker->name(),
            'publisher' => $this->faker->name(),
            'for_adult' => $this->faker->randomElement([true, false]),
            'price' => $this->faker->numberBetween(1, 100000)
        ];
    }
}
