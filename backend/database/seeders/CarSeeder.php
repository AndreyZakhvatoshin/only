<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = DB::table('car_models')->pluck('id', 'model');
        $drivers = DB::table('users')
            ->whereIn('position_id', function ($q) {
                $q->select('id')->from('positions')->where('title', 'Водитель');
            })
            ->pluck('id')->toArray();


        DB::table('cars')->insert([
            [
                'model_id' => $models['Camry'],
                'driver_id' => $drivers[0],
                'registration_number' => 'A123BC77',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'model_id' => $models['5 Series'],
                'driver_id' => $drivers[1],
                'registration_number' => 'B456CD77',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'model_id' => $models['Solaris'],
                'driver_id' => $drivers[2],
                'registration_number' => 'C789DE77',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
