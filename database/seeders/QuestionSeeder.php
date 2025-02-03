<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::insert([
            [
                'title' => 'Ini adalah judul pertanyaan 1',
                'description' => 'lorem ipsit amet sed do eiusum dunt ut laboreolor smod tempor incidid et dolore magna aliqua',
                'is_phising' => 1,
                'image' => 'quests__1hIaJfF4XE4AcaEuTs4scHvmRu28nhKYdxGb9qfA.png',
                'proof' => 'Ini adalah judul bukti jawaban 1',
                'test_id' => 1,
                'category_id' => 1
            ],
            [
                'title' => 'Ini adalah judul pertanyaan 2',
                'description' => 'lorem ipsum dolor sit amet sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                'is_phising' => 0,
                'image' => 'quests__1hIaJfF4XE4AcaEuTs4scHvmRu28nhKYdxGb9qfA.png',
                'proof' => 'Ini adalah judul bukti jawaban 2',
                'test_id' => 1,
                'category_id' => 2
            ]
        ]);
    }
}
