<!-- resources/views/videos/index.blade.php -->

@extends('layouts.main')

@section('title', 'Все видео')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:py-12 max-w-7xl">
        <!-- Заголовок -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white">
                Все видео
                <!-- Если страница канала: -->
                <!-- @if(isset($channel))Видео канала «{{ $channel->title }}»@endif -->
            </h1>

            <!-- Можно добавить сортировку/фильтры позже -->
            <!-- <div class="flex gap-3">
                <button class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition">По дате</button>
                <button class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition">По популярности</button>
            </div> -->
        </div>

        <!-- Контент -->
        @if($videos->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-3 gap-5 md:gap-6">
                @foreach($videos as $video)
                    <div class="group relative rounded-xl overflow-hidden bg-gray-900 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <!-- Карточка целиком кликабельна, но пока без реальной ссылки -->
                        <a href="{{ route('videos.show', $video->id) }}"
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

                                <!-- Оверлей Play -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-red-600/90 flex items-center justify-center shadow-xl transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Здесь можно добавить длительность, если добавишь поле -->
                                <!-- <span class="absolute bottom-2 right-2 px-2 py-0.5 bg-black/70 text-white text-xs font-medium rounded">14:22</span> -->
                            </div>

                            <!-- Информация -->
                            <div class="p-4">
                                <h3 class="text-base md:text-lg font-semibold text-white mb-2 line-clamp-2 group-hover:text-red-400 transition-colors duration-200">
                                    {{ $video->title }}
                                </h3>

                                <div class="flex items-center justify-between text-sm text-gray-400">
                                    <a href="{{ route('channels.show', $video->channel) }}"
                                       class="hover:text-white transition-colors line-clamp-1">
                                        {{ $video->channel->title ?? 'Неизвестный канал' }}
                                    </a>

                                    <!-- Просмотры (добавь поле views_count в модель, если нужно) -->
                                    <!-- <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                        </svg>
                                        <span>128 тыс.</span>
                                    </span> -->
                                </div>

                                <!-- Жанр + дата -->
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

                                    <!-- <span class="hidden sm:inline">• {{ $video->created_at->diffForHumans() }}</span> -->
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
            <div class="text-center py-24 text-gray-400">
                <div class="text-5xl mb-6">📹</div>
                <h2 class="text-2xl md:text-3xl font-semibold mb-4">Видео пока нет</h2>
                <p class="text-lg">Здесь скоро появятся интересные ролики. Возвращайтесь позже!</p>
            </div>
        @endif
    </div>
@endsection