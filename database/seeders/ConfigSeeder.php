<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::insert([
            [
                'key' => 'tutorial_video',
                'value' => '-',
                'is_active' => 0
            ],
            [
                'key' => 'yes_choice',
                'value' => 'Phising',
                'is_active' => 1
            ],
            [
                'key' => 'no_choice',
                'value' => 'Tidak',
                'is_active' => 1
            ],
            [
                'key' => 'qr_donasi',
                'value' => '-',
                'is_active' => 1
            ],
            [
                'key' => 'link_pengaduan',
                'value' => 'https://forms.gle/qQ71ZdyXDoz34NF46',
                'is_active' => 1
            ]
        ]);
    }
}
