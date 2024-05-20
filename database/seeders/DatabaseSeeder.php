<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BrandSeeder::class,
            LocationSeeder::class,
            YearSeeder::class,
            ColorSeeder::class,
        ]);
        \App\Models\Car::factory(500)->create();
        \App\Models\User::factory(10)->create();
    }
}
