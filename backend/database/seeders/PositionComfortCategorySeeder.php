<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionComfortCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = DB::table('positions')->pluck('id', 'title');
        $categories = DB::table('comfort_categories')->pluck('id', 'level');

        DB::table('position_comfort_category')->insert([

            ['position_id' => $positions['Менеджер'], 'comfort_category_id' => $categories[2],],
            ['position_id' => $positions['Менеджер'], 'comfort_category_id' => $categories[3],],

            ['position_id' => $positions['Директор'], 'comfort_category_id' => $categories[1],],

            ['position_id' => $positions['Сотрудник отдела продаж'], 'comfort_category_id' => $categories[3],],

            ['position_id' => $positions['Специалист по закупкам'], 'comfort_category_id' => $categories[2],],
        ]);
    }
}
