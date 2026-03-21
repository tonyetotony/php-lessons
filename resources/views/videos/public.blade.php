<!-- resources/views/videos/public.blade.php -->

@extends('layouts.main')

@section('title', 'Все видео')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Заголовок -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                Все видео
            </h1>
            <p class="text-gray-400">
                Посмотрите лучшие видео от наших авторов
            </p>
        </div>

        <!-- Фильтры -->
        <div class="mb-6">
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                <form method="GET" action="{{ route('videos.public') }}" class="flex flex-col sm:flex-row gap-4 items-center">
                    <label for="filter" class="text-gray-300 min-w-max">Показать:</label>
                    <select
                        name="filter"
                        id="filter"
                        onchange="this.form.submit()"
                        class="px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent"
                    >
                        <option value="all" {{ request('filter') === 'all' || !request('filter') ? 'selected' : '' }}>Все видео</option>
                        <option value="mine" {{ request('filter') === 'mine' ? 'selected' : '' }}>Только мои видео</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Список видео или сообщение об отсутствии видео -->
        @if($videos->isEmpty())
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto mb-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h18M3 16h18" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-400 mb-2">Нет доступных видео</h3>
                @if(request('filter') === 'mine')
                    <p class="text-gray-500">У вас пока нет видео. Создайте канал и добавьте первое видео!</p>
                @else
                    <p class="text-gray-500">Пока нет ни одного видео. Загляните позже!</p>
                @endif
            </div>
        @else
            <!-- Сетка видео -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($videos as $video)
                    <a href="{{ route('videos.show', $video) }}"
                       class="group block bg-gray-800 rounded-xl overflow-hidden hover:bg-gray-750 transition transform hover:scale-105 shadow-lg">
                        <!-- Обложка видео -->
                        <div class="relative pb-[56.25%]">
                            <img src="{{ asset($video->cover_path) }}"
                                 alt="Обложка видео {{ $video->title }}"
                                 class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            <!-- Иконка плей -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Информация о видео -->
                        <div class="p-4">
                            <h3 class="text-white font-semibold text-sm line-clamp-2 mb-2 group-hover:text-red-400 transition">
                                {{ $video->title }}
                            </h3>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>{{ $video->channel?->title ?? 'Без канала' }}</span>
                                <span>{{ $video->genre_label }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Пагинация -->
            <div class="mt-8">
                {{ $videos->links() }}
            </div>
        @endif
    </div>
@endsection