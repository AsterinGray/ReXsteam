<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::Create(['name' => 'Mystery']);
        Genre::Create(['name' => 'Adventure']);
        Genre::Create(['name' => 'RPG']);
        Genre::Create(['name' => 'Puzzle']);
        Genre::Create(['name' => 'Sport']);
        Genre::Create(['name' => 'Fantasy']);
        Genre::Create(['name' => 'Simulation']);
        Genre::Create(['name' => 'Strategy']);
        Genre::Create(['name' => 'Action']);
        Genre::Create(['name' => 'Role Playing']);
        Genre::Create(['name' => 'Sci-fi']);
    }
}
