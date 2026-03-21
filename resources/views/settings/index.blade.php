@extends('layouts.main')

@section('content')

    <div class="min-h-screen bg-gray-950 text-gray-100 pb-12">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">

            <!-- Заголовок + кнопка создания -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-10 gap-4">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Родительские настройки</h1>
                    <p class="mt-2 text-gray-400">Глобальные группы настроек платформы</p>
                </div>

                <a href="{{ route('settings.create') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 rounded-lg font-medium text-white shadow-lg shadow-purple-900/30 transition-all transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Создать группу настроек
                </a>
            </div>

            <!-- Таблица / карточки -->
            @if($parentSettings->isEmpty())
                <div class="bg-gray-900/60 border border-gray-800 rounded-xl p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-300 mb-2">Пока нет родительских настроек</h3>
                    <p class="text-gray-500 mb-6">Создайте первую группу, чтобы организовать настройки платформы</p>
                    <a href="{{ route('settings.create') }}" class="text-purple-400 hover:text-purple-300 font-medium">
                        Создать группу →
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(auth()->user()->settings()->groupBy(['user_id', 'setting_id'])->get() as $setting)
                        <div class="group bg-gray-900/70 border border-gray-800 rounded-xl overflow-hidden hover:border-purple-600/50 transition-all duration-300 hover:shadow-xl hover:shadow-purple-900/20">

                            <!-- Верхняя часть с названием -->
                            <div class="px-6 pt-6 pb-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-white group-hover:text-purple-300 transition-colors">
                                            {{ $setting->pivot->name }}
                                        </h3>
                                    </div>

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900/40 text-green-400 border border-green-700/50">
                                    Активна
                                </span>
                                </div>
                            </div>

                            <!-- Действия -->
                            <div class="px-6 pb-6 pt-2 flex items-center justify-end gap-3 border-t border-gray-800/70 mt-2">
                                <a href="{{ route('settings.edit', $setting->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg text-sm font-medium text-gray-300 hover:text-white transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Редактировать
                                </a>

{{--                                <form action="{{ route('settings.destroy', $setting->id) }}" method="POST"--}}
                                <form action="#" method="POST"
                                      onsubmit="return confirm('Удалить группу «{{ addslashes($setting->name) }}» и все вложенные настройки?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-900/40 hover:bg-red-800/60 border border-red-700/50 rounded-lg text-sm font-medium text-red-300 hover:text-red-200 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Пагинация (если нужно) -->
            <div class="mt-10">
                {{ $parentSettings->links('pagination::tailwind') }}
            </div>

        </div>
    </div>

@endsection