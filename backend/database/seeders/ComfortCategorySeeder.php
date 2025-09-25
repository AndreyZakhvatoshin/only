<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComfortCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comfort_categories')->insert([
            [
                'name' => 'Первая',
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Вторая',
                'level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Третья',
                'level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
