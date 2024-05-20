<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['name' => 'Aşgabat', 'name_en' => 'Ashgabat'],
            ['name' => 'Ahal', 'name_en' => null],
            ['name' => 'Balkan', 'name_en' => null],
            ['name' => 'Daşoguz', 'name_en' => null],
            ['name' => 'Lebap', 'name_en' => null],
            ['name' => 'Mary', 'name_en' => null],
        ];

        foreach ($locations as $location) {
            $obj = new Location();
            $obj->name = $location['name'];
            $obj->name_en = $location['name_en'];
            $obj->save();
        }
    }
}
