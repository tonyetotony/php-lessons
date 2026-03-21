<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'name' => 'Настройка фильтров'
            ],
            [
                'name' => 'Настройка валидации видео'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::query()->firstOrCreate([
                'name' => $setting['name'],
            ], [
                'name' => $setting['name'],
            ]);
        }
    }
}