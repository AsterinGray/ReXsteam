<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call([GenreSeeder::class]);
        \App\Models\Game::factory(10)->create();
        \App\Models\Friend::factory(10)->create();
        \App\Models\TransactionHeader::factory(10)->create();
        \App\Models\TransactionDetail::factory(10)->create();
    }
}
