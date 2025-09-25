<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('comfort_categories')->pluck('id', 'level');

        DB::table('car_models')->insert([
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'comfort_category_id' => $categories[2],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'BMW',
                'model' => '5 Series',
                'comfort_category_id' => $categories[1],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Solaris',
                'comfort_category_id' => $categories[3],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
