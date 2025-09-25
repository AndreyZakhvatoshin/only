<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = DB::table('positions')->pluck('id', 'title');

        $users = [
            [
                'name' => 'Иван Петров',
                'email' => 'director@example.com',
                'password' => Hash::make('password'),
                'position_id' => $positions['Директор'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ольга Смирнова',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'position_id' => $positions['Менеджер'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Александр Егоров',
                'email' => 'sales@example.com',
                'password' => Hash::make('password'),
                'position_id' => $positions['Сотрудник отдела продаж'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Марина Кузнецова',
                'email' => 'purchase@example.com',
                'password' => Hash::make('password'),
                'position_id' => $positions['Специалист по закупкам'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Сергей Кузнецов',
                'email' => 'driver1@example.com',
                'password' => Hash::make('password'),
                'position_id' => $positions['Водитель'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Алексей Иванов',
                'email' => 'driver2@example.com',
                'password' => Hash::make('password'),
                'position_id' => $positions['Водитель'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Дмитрий Орлов',
                'email' => 'driver3@example.com',
                'password' => Hash::make('password'),
                'position_id' => $positions['Водитель'],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
