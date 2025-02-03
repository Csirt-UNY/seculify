<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Test::insert([
            [
                'title' => 'Test 1',
                'description' => 'Test 1 description',
                'level' => 'mudah'
            ],
            [
                'title' => 'Test 2',
                'description' => 'Test 2 description',
                'level' => 'sedang'
            ],
            [
                'title' => 'Test 3',
                'description' => 'Test 3 description',
                'level' => 'sulit'
            ],
        ]);
    }
}
