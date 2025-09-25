<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            ['title' => 'Менеджер', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Директор', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Водитель', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Сотрудник отдела продаж', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Специалист по закупкам', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
