<!-- resources/views/channels/create.blade.php -->

@extends('layouts.main')

@section('title', 'Создать канал')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
            <!-- Заголовок формы -->
            <div class="px-6 py-5 border-b border-gray-800">
                <h1 class="text-2xl md:text-3xl font-bold text-white">
                    Создать новый канал
                </h1>
                <p class="mt-2 text-gray-400">
                    Заполните информацию о вашем канале.
                </p>
            </div>

            <!-- Форма -->
            <form action="{{ route('channels.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf

                <!-- Название канала -->
                <div class="mb-6">
                    <label for="title" class="block text-lg font-medium text-gray-200 mb-2">
                        Название канала <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                        placeholder="Например: Мой крутой канал 2026"
                    >
                    @error('title')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Описание контента -->
                <div class="mb-6">
                    <label for="description" class="block text-lg font-medium text-gray-200 mb-2">
                        Описание контента <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition resize-y"
                        placeholder="Что будет на вашем канале? О чём видео, какие темы, какая аудитория?"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Информация об авторе -->
                <div class="mb-6">
                    <label for="author_info" class="block text-lg font-medium text-gray-200 mb-2">
                        Информация об авторе <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="author_info"
                        id="author_info"
                        rows="4"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition resize-y"
                        placeholder="Кто вы? Почему соз��али канал? Расскажите немного о себе, своих интересах, опыте."
                    >{{ old('author_info') }}</textarea>
                    @error('author_info')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Аватар канала -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-200 mb-2">
                        Аватар канала <span class="text-gray-500">(необязательно)</span>
                    </label>
                    <input
                        type="file"
                        name="cover"
                        accept="image/*"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                    >
                    <p class="mt-2 text-sm text-gray-500">
                        Рекомендуемый размер: 800x800 пикселей. Поддерживаемые форматы: JPG, PNG, WEBP.
                    </p>
                    @error('cover')
                    <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Кнопки отправки -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('videos.public') }}"
                       class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition text-center">
                        Отмена
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Создать канал
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection