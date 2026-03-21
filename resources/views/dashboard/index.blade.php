@extends('layouts.main')

@section('content')

    <div class="min-h-screen bg-gray-950 text-gray-100 pb-12">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">

            <!-- Приветствие + быстрые действия -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold tracking-tight">Добро пожаловать, Anton</h1>
                <p class="mt-2 text-gray-400">Вот что происходит с твоим контентом за последние 30 дней</p>

                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="{{ route('videos.create') }}" class="inline-flex items-center px-5 py-2.5 bg-purple-600 hover:bg-purple-700 rounded-lg font-medium transition-colors shadow-lg shadow-purple-900/20">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Загрузить видео
                    </a>
                    <button class="inline-flex items-center px-5 py-2.5 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Создать Shorts
                    </button>
                </div>
            </div>

            <!-- Статистика (4 карточки) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-gray-900/70 border border-gray-800 rounded-xl p-6 hover:border-purple-600/40 transition-colors">
                    <p class="text-sm text-gray-400">Просмотры</p>
                    <p class="text-3xl font-bold mt-1">184,2 тыс</p>
                    <p class="text-sm mt-2 text-green-400">+18% за 30 дней</p>
                </div>
                <div class="bg-gray-900/70 border border-gray-800 rounded-xl p-6 hover:border-purple-600/40 transition-colors">
                    <p class="text-sm text-gray-400">Время просмотра</p>
                    <p class="text-3xl font-bold mt-1">3 420 ч</p>
                    <p class="text-sm mt-2 text-green-400">+24%</p>
                </div>
                <div class="bg-gray-900/70 border border-gray-800 rounded-xl p-6 hover:border-purple-600/40 transition-colors">
                    <p class="text-sm text-gray-400">Подписчики</p>
                    <p class="text-3xl font-bold mt-1">12.4 тыс</p>
                    <p class="text-sm mt-2 text-green-400">+1 280</p>
                </div>
                <div class="bg-gray-900/70 border border-gray-800 rounded-xl p-6 hover:border-purple-600/40 transition-colors">
                    <p class="text-sm text-gray-400">Доход</p>
                    <p class="text-3xl font-bold mt-1">$1,840</p>
                    <p class="text-sm mt-2 text-purple-400">Выплаты через 8 дней</p>
                </div>
            </div>

            <!-- Последние видео -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-2xl font-semibold">Последние видео</h2>
                    <a href="#" class="text-purple-400 hover:text-purple-300 text-sm font-medium flex items-center gap-1">
                        Показать все
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Повторить 4 раза или использовать -->
                    <div class="group bg-gray-900/50 rounded-xl overflow-hidden border border-gray-800 hover:border-purple-600/50 transition-all hover:shadow-xl hover:shadow-purple-900/10">
                        <div class="relative aspect-video bg-gray-800">
                            <img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=800" alt="Video thumbnail" class="w-full h-full object-cover">
                            <div class="absolute bottom-2 right-2 bg-black/70 px-2 py-1 rounded text-xs font-medium">12:45</div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium line-clamp-2 group-hover:text-purple-300 transition-colors">Как снимать крутые видео на телефон в 2026 году</h3>
                            <div class="mt-3 flex items-center justify-between text-sm text-gray-400">
                                <span>184K просмотров</span>
                                <span>3 дня назад</span>
                            </div>
                        </div>
                    </div>

                    <!-- Можно скопировать блок выше ещё 3 раза с разными картинками/названиями -->
                </div>
            </div>

            <!-- Быстрые ссылки / тренды / идеи -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-gray-900 to-gray-950 border border-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-semibold mb-4">Тренды для видео прямо сейчас</h3>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-center gap-3">
                            <span class="text-purple-400">•</span> AI-монтаж за 60 секунд
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-purple-400">•</span> Реакции на новые гаджеты 2026
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-purple-400">•</span> "День из жизни" в 4K 120fps
                        </li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-gray-900 to-gray-950 border border-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-semibold mb-4">Быстрые действия</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <button class="py-4 bg-gray-800/70 hover:bg-gray-700 rounded-lg transition-colors flex flex-col items-center justify-center gap-2 border border-gray-700">
                            <svg class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span class="text-sm">Редактировать</span>
                        </button>
                        <button class="py-4 bg-gray-800/70 hover:bg-gray-700 rounded-lg transition-colors flex flex-col items-center justify-center gap-2 border border-gray-700">
                            <svg class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span class="text-sm">Аналитика</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection