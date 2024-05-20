<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Ak', 'name_en' => 'White'],
            ['name' => 'Gara', 'name_en' => 'Black'],
            ['name' => 'Gök', 'name_en' => 'Blue'],
            ['name' => 'Ýaşyl', 'name_en' => 'Green'],
            ['name' => 'Sary', 'name_en' => 'Yellow'],
            ['name' => 'Gyzyl', 'name_en' => 'Red'],
            ['name' => 'Çal', 'name_en' => 'Gray'],
        ];

        foreach ($colors as $color) {
            $obj = new Color();
            $obj->name = $color['name'];
            $obj->name_en = $color['name_en'];
            $obj->save();
        }
    }
}
