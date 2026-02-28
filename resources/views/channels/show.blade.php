<!-- resources/views/channels/show.blade.php -->

@extends('layouts.main')

@section('title', $channel->title . ' — канал')

@section('content')
    <div class="container mx-auto px-4 py-6 lg:py-10 max-w-7xl">
        <!-- Большая обложка канала -->
        <div class="relative w-full h-64 md:h-80 lg:h-96 rounded-xl overflow-hidden mb-8 shadow-2xl">
            @if($channel->background_path)
                <img
                    src="{{ asset($channel->background_path) }}"
                    alt="Обложка канала {{ $channel->title }}"
                    class="w-full h-full object-cover"
                >
            @else
                <div class="w-full h-full bg-gradient-to-r from-indigo-900 via-purple-900 to-pink-900"></div>
            @endif

            <!-- Градиентное затемнение для читаемости -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
        </div>

        <!-- Информация о канале -->
        <div class="flex flex-col md:flex-row gap-6 md:gap-8 mb-10 -mt-16 md:-mt-24 relative z-10">
            <!-- Аватар -->
            <div class="flex-shrink-0">
                <div class="w-28 h-28 md:w-36 md:h-36 lg:w-40 lg:h-40 rounded-full overflow-hidden border-4 border-white shadow-xl bg-white">
                    @if($channel->cover_path)
                        <img
                            src="{{ asset($channel->cover_path) }}"
                            alt="{{ $channel->title }}"
                            class="w-full h-full object-cover"
                        >
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center text-5xl md:text-6xl font-bold text-gray-600">
                            {{ strtoupper(substr($channel->title, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Основная информация -->
            <div class="flex-1 text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-3">{{ $channel->title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-gray-300 mb-4 text-sm md:text-base">
                    <span class="font-medium">{{ number_format($channel->subscribers_count ?? 123456, 0, '', ' ') }} подписчиков</span>
                    <span>•</span>
                    <span>{{ $channel->videos_count ?? $channel->videos()->count() }} видео</span>
                </div>

                <p class="text-gray-300 max-w-3xl mb-6 leading-relaxed">
                    {{ $channel->description ?? 'Канал без описания. Здесь скоро появятся интересные видео!' }}
                </p>

                <!-- Кнопки действий -->
                <div class="flex flex-wrap gap-3">
                    <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-full transition shadow-md">
                        Подписаться
                    </button>
                    <button class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-full transition">
                        Донат
                    </button>
                </div>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="border-b border-gray-700 mb-6">
            <nav class="flex gap-8 md:gap-10 text-base md:text-lg font-medium overflow-x-auto pb-1">
                <a href="#" class="pb-4 border-b-4 border-red-600 text-white whitespace-nowrap">Видео</a>
                <a href="#" class="pb-4 text-gray-400 hover:text-white transition whitespace-nowrap">Плейлисты</a>
                <a href="#" class="pb-4 text-gray-400 hover:text-white transition whitespace-nowrap">О канале</a>
                <a href="#" class="pb-4 text-gray-400 hover:text-white transition whitespace-nowrap">Сообщество</a>
            </nav>
        </div>

        <!-- Сетка видео канала -->
        @if($channel->videos->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-5 md:gap-6">
                @foreach($channel->videos as $video)
                    <div class="group relative rounded-xl overflow-hidden bg-gray-900 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <a href="javascript:void(0)"
                           class="block focus:outline-none focus:ring-2 focus:ring-red-600 rounded-xl">

                            <!-- Превью -->
                            <div class="relative aspect-video bg-black overflow-hidden">
                                @if($video->cover_path)
                                    <img
                                        src="{{ $video->cover_path }}"
                                        alt="{{ $video->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-950">
                                        <span class="text-gray-500 text-lg font-medium">Нет обложки</span>
                                    </div>
                                @endif

                                <!-- Play overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-red-600/90 flex items-center justify-center shadow-xl transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Информация под видео -->
                            <div class="p-4">
                                <h3 class="text-base md:text-lg font-semibold text-white mb-2 line-clamp-2 group-hover:text-red-400 transition-colors duration-200">
                                    {{ $video->title }}
                                </h3>

                                <div class="flex items-center justify-between text-sm text-gray-400">
                                    <span class="line-clamp-1">
                                        {{ $channel->title }}
                                    </span>
                                </div>

                                <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-gray-400">
                                    @if($video->genre)
                                        <span class="px-2.5 py-1 bg-gray-800 text-gray-200 rounded-full">
                                            {{ $video->genre }}
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 bg-gray-800 text-gray-200 rounded-full">
                                            Без жанра
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Пагинация -->
            <div class="mt-10 md:mt-12">
                {{ $videos->links('pagination::tailwind') }}
            </div>

        @else
            <div class="text-center py-20 md:py-28 text-gray-400 bg-gray-900/30 rounded-xl">
                <div class="text-6xl mb-6">📹</div>
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">На канале пока нет видео</h2>
                <p class="text-lg max-w-md mx-auto">
                    Как только появятся новые ролики — они красиво отобразятся здесь.
                </p>
            </div>
        @endif
    </div>
@endsection