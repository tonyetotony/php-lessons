<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channels = [
            [
                'title' => 'Телеканал ТНТ',
                'description' => 'Официальный аккаунт телеканала ТНТ
                 Регистрация в РКН: https://www.gosuslugi.ru/snet/67ad40513687544fb531d928',
                'cover_path' => 'public/videos_path/7b0eff0bb0664dd72c544191a27bc615.jpg',
                'background_path' => 'public/videos_path/abedb24aa75ff3828f6f6a3808774e25.jpeg',
                'user_id' => User::query()->where('email', 'admin@mail.ru')->first()->id,
            ]
        ];

        foreach ($channels as $channel) {

            $channelObject = Channel::query()
                ->where('title', $channel['title'])
                ->first();

            if ($channelObject) {
                continue;
            }

            $channel['cover_path'] = $this->fileMv($channel['cover_path'], 'cover');
            $channel['background_path'] = $this->fileMv($channel['background_path'], 'background');

            Channel::query()->create(
                $channel
            );
        }
    }

    public function fileMv(string $filePath, string $folderName): string
    {
        // Получаем содержимое файла
        $content = file_get_contents($filePath);

        // Генерируем хешированное имя (md5 + оригинальный расширение)
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $hashedName = md5($filePath . time()) . '.' . $extension;


        $storagePath = $folderName . '/' . $hashedName;

        Storage::disk('public')->put($storagePath, $content);

        // Получаем публичный путь
        return Storage::url($storagePath);
    }
}