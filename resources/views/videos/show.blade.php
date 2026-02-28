<!-- resources/views/videos/show.blade.php -->

@extends('layouts.main')

@section('title', $video->title)

@section('content')
    <div class="container mx-auto px-4 py-6 lg:py-8 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Основная часть: плеер + информация о видео -->
            <div class="lg:col-span-2">
                <!-- Плеер -->
                <div class="relative w-full aspect-video bg-black rounded-xl overflow-hidden shadow-2xl mb-6">
                    <iframe
                        src="{{ $video->path }}"
                        width="100%"
                        height="100%"
                        frameborder="0"
                        allow="clipboard-write; autoplay; fullscreen; picture-in-picture; encrypted-media"
                        allowfullscreen
                        class="absolute inset-0"
                    ></iframe>
                </div>

                <!-- Название видео -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-shadow-emerald-900 mb-3 leading-tight">
                    {{ $video->title }}
                </h1>

                <!-- Метаданные: просмотры, дата, жанр -->
                <div class="flex flex-wrap items-center gap-4 text-gray-400 text-sm md:text-base mb-4">
                    <span>145 678 просмотров</span> <!-- потом подключишь реальное поле -->
                    <span>•</span>
                    <span>{{ $video->created_at->diffForHumans() }}</span>
                    <span>•</span>
                    @if($video->genre)
                        <span class="px-3 py-1 bg-gray-800 rounded-full text-gray-200">
                            {{ $video->genre }}
                        </span>
                    @endif
                </div>

                <!-- Описание -->
                <div class="bg-gray-900 rounded-xl p-5 md:p-6 mb-6">
                    <p class="text-gray-300 leading-relaxed whitespace-pre-line">
                        {{ $video->description ?? 'Описание отсутствует' }}
                    </p>
                </div>

                <!-- Канал + действия -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 bg-gray-900 rounded-xl p-5 md:p-6 mb-8">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('channels.show', $video->channel) }}">
                            <div class="w-14 h-14 md:w-16 md:h-16 rounded-full overflow-hidden border-2 border-gray-700 flex-shrink-0">
                                @if($video->channel->cover_path)
                                    <img
                                        src="{{ asset($video->channel->cover_path) }}"
                                        alt="{{ $video->channel->title }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full bg-gray-700 flex items-center justify-center text-2xl font-bold text-gray-400">
                                        {{ strtoupper(substr($video->channel->title, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div>
                            <a href="{{ route('channels.show', $video->channel) }}"
                               class="text-lg md:text-xl font-semibold text-white hover:text-red-400 transition">
                                {{ $video->channel->title }}
                            </a>
                            <p class="text-sm text-gray-400">
                                {{ number_format($video->channel->subscribers_count ?? 123456, 0, '', ' ') }} подписчиков
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-full transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            Подписаться
                        </button>
                        <button class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition">
                            Донат
                        </button>
                    </div>
                </div>

                <!-- Кнопки действий под видео (лайки, поделиться и т.д.) -->
                <div class="flex flex-wrap gap-4 mb-10">
                    <button class="flex items-center gap-2 px-5 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-full transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        <span>12 тыс.</span>
                    </button>
                    <button class="flex items-center gap-2 px-5 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-full transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M15 3H6c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V9l-6-6zm4 18H6V5h7v4h6v12zM9 17h6v-2H9v2zm0-4h6v-2H9v2z"/></svg>
                        <span>Сохранить</span>
                    </button>
                    <button class="flex items-center gap-2 px-5 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-full transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/></svg>
                        <span>Поделиться</span>
                    </button>
                </div>
            </div>

            <!-- Правая колонка: похожие видео -->
            <div class="lg:col-span-1">
                <h2 class="text-2xl font-bold text-white mb-5">Похожие видео</h2>

                <div class="space-y-5">
                    <!-- Здесь будет цикл по рекомендациям -->
                    @forelse($relatedVideos ?? [] as $related)
                        <a href="{{ route('videos.show', $related) }}" class="group flex gap-3">
                            <div class="relative w-40 aspect-video flex-shrink-0 rounded-lg overflow-hidden bg-black">
                                <img
                                    src="{{ $related->cover_path }}"
                                    alt="{{ $related->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-medium line-clamp-2 group-hover:text-red-400 transition">
                                    {{ $related->title }}
                                </h4>
                                <p class="text-sm text-gray-400 mt-1">
                                    {{ $related->channel->title }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    89 тыс. просмотров • 2 дня назад
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="text-gray-500 text-center py-8">
                            Похожие видео скоро появятся здесь
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection