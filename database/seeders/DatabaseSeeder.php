<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\PhoneBrand;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $phoneBrands = [
            'Iphone',
            'Nokia',
            'Xiaomi',
            'Sony',
        ];

        foreach ($phoneBrands as $brand) {
            PhoneBrand::query()->firstOrCreate([
                'name' => $brand,
            ], [
                'name' => $brand,
            ]);
        }

        if (!User::query()->where('email', 'admin@mail.ru')->exists()) {
            User::query()->create([
                'name' => 'Admin',
                'email' => 'admin@mail.ru',
                'password' => Hash::make('adminadmin'),
            ]);
        }

        User::factory()
            ->has(Phone::factory()->count(3), 'phones')
            ->count(100)->create();

        $this->call([
            ChannelSeeder::class,
            VideoSeeder::class,
        ]);
    }
}