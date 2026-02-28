<!-- resources/views/videos/create.blade.php -->

@extends('layouts.main')

@section('title', 'Добавить новое видео')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
            <!-- Заголовок формы -->
            <div class="px-6 py-5 border-b border-gray-800">
                <h1 class="text-2xl md:text-3xl font-bold text-white">
                    Загрузить видео
                </h1>
                <p class="mt-2 text-gray-400">
                    Заполните информацию о видео. Обложка и Rutube-ссылка обязательны.
                </p>
            </div>

            <!-- Форма -->
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf

                <!-- Название видео -->
                <div class="mb-6">
                    <label for="title" class="block text-lg font-medium text-gray-200 mb-2">
                        Название видео <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                        placeholder="Например: Самый эпичный момент в игре 2025"
                    >
                    @error('title')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Описание -->
                <div class="mb-6">
                    <label for="description" class="block text-lg font-medium text-gray-200 mb-2">
                        Описание
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="6"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition resize-y"
                        placeholder="Расскажите, о чём видео, ключевые моменты, таймкоды и т.д..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Жанр -->
                <div class="mb-6">
                    <label for="genre" class="block text-lg font-medium text-gray-200 mb-2">
                        Жанр видео <span class="text-red-500">*</span>
                    </label>
                    <select
                        name="genre"
                        id="genre"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                    >
                        <option value="" disabled {{ old('genre') ? '' : 'selected' }}>Выберите жанр</option>
                        @foreach(App\VideoGenre::options() as $option)
                            <option
                                value="{{ $option['value'] }}" {{ old('genre') == $option['value'] ? 'selected' : '' }}>
                                {{ $option['label'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rutube embed / ссылка -->
                <div class="mb-6">
                    <label for="path" class="block text-lg font-medium text-gray-200 mb-2">
                        Ссылка на Rutube (embed) <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="path"
                        id="path"
                        value="{{ old('path') }}"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                        placeholder="https://rutube.ru/play/embed/xxxxxxxxxxxxxx/"
                    >
                    <p class="mt-2 text-sm text-gray-500">
                        Вставьте ссылку вида: https://rutube.ru/play/embed/...
                    </p>
                    @error('path')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Обложка (превью) -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-200 mb-2">
                        Обложка видео <span class="text-red-500">*</span>
                    </label>
                    <input type="url" name="cover" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"">

                    @error('cover')
                    <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Кнопки отправки -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('videos.index') }}"
                       class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition text-center">
                        Отмена
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Опубликовать видео
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('cover').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    const img = document.getElementById('preview-img');
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection