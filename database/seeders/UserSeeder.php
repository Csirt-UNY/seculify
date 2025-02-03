<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'account_type' => 'normal',
                'role' => 'admin',
            ],
            [
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('apapapap'),
                'account_type' => 'normal',
                'role' => 'user',
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('apapapap'),
                'account_type' => 'normal',
                'role' => 'user',
            ],
            [
                'name' => 'Admin Soal',
                'email' => 'adminsoal@gmail.com',
                'password' => bcrypt('adminsoal123'),
                'account_type' => 'normal',
                'role' => 'creator',
            ],
        ]);
    }
}
