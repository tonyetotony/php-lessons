<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Video;
use App\Services\FolderService;
use App\VideoGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title' => 'ТИТАНЫ, 4 сезон, 4 выпуск',
                'description' => 'Самый масштабный спортивный проект запускает битву сезонов! Теперь лучшие из лучших и сильнейшие из сильнейших атлетов сойдутся в эпических схватках.',
                'cover_path' => 'public/videos_path/0f2043d979f6d82b88a14e1057039261.jpg',
                'path' => 'https://rutube.ru/play/embed/11b0c02e3f21e70d6e97922545f888fd/',
                'channel_id' => Channel::query()->where('title', 'Телеканал ТНТ')->first()->id,
                'genre' => VideoGenre::SPORTS->label()
            ],
            [
                'title' => 'ТИТАНЫ, 4 сезон, 3 выпуск',
                'description' => 'Самый масштабный спортивный проект запускает битву сезонов! Теперь лучшие из лучших и сильнейшие из сильнейших атлетов сойдутся в эпических схватках.',
                'cover_path' => 'https://pic.rtbcdn.ru/video/2026-02-08/09/d7/09d7fd06dbbcfa0e9e80d096eb6fdbaa.jpg?width=500',
                'path' => 'https://rutube.ru/play/embed/f9102594cede42f29c4304fd618d1d58/',
                'channel_id' => Channel::query()->where('title', 'Телеканал ТНТ')->first()->id,
                'genre' => VideoGenre::SPORTS->label()
            ],

        ];

        foreach ($videos as $video) {
            if (
                Video::query()
                    ->where('path', $video['path'])
                    ->where('channel_id', $video['channel_id'])
                    ->where('genre', $video['genre'])
                    ->exists()
            ){
                continue;
            }

            $video['cover_path'] = (new FolderService())->fileMv($video['cover_path'], 'cover');

            Video::query()->create($video);
        }
    }
}