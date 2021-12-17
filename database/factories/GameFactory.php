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
            'image_preview' => $this->faker->image(),
            'trailer_video' => $this->faker->image(),
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
