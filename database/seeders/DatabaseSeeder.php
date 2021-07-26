<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\ResourceFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([UserSeeder::class]);
        $this->call([ResourceSeeder::class]);
    }
}
