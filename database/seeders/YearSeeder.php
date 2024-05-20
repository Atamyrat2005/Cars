<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = range(2018, 2023);

        foreach ($years as $year) {
            $obj = new Year();
            $obj->name = $year;
            $obj->save();
        }
    }
}
