<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brand = DB::table('brands')->inRandomOrder()->first();
        $location = DB::table('locations')->inRandomOrder()->first();
        $year = DB::table('years')->inRandomOrder()->first();
        $color = DB::table('colors')->inRandomOrder()->first();
        $createdAt = fake()->dateTimeBetween('-1 year', '-1 week');
        return [
            'brand_id' => $brand->id,
            'location_id' => $location->id,
            'year_id' => $year->id,
            'color_id' => $color->id,
            'description' => fake()->paragraph(),
            'price' => rand(50, 500),
            'viewed' => rand(0, 100),
            'active' => fake()->boolean(90),
            'created_at' => $createdAt,
            'updated_at' => Carbon::parse($createdAt)->addDays(rand(0, 6))->addHours(rand(0, 23)),
        ];
    }
}
