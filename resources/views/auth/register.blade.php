@extends('layouts.main')

@section('content')

    <div class="min-h-screen bg-gray-950 flex items-center justify-center p-4">
        <!-- Лёгкий декоративный фон -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-950/25 via-indigo-950/15 to-gray-950 opacity-70"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,rgba(236,72,153,0.08),transparent_50%)]"></div>
        </div>

        <div class="relative w-full max-w-md">
            <div class="bg-gray-900/70 backdrop-blur-xl border border-gray-800/80 rounded-2xl shadow-2xl shadow-purple-950/30 overflow-hidden">

                <!-- Верхняя часть -->
                <div class="px-8 pt-10 pb-6 text-center">
                    <div class="mx-auto w-16 h-16 rounded-xl bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg shadow-purple-900/40 mb-4">
                        V
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight">Создать аккаунт в VideoHub</h2>
                    <p class="mt-2 text-gray-400 text-sm">
                        Начни загружать видео, собирать аудиторию и зарабатывать уже сегодня
                    </p>
                </div>

                <!-- Форма регистрации -->
                <div class="px-8 pb-10">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Имя -->
                        <div class="mb-5">
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                                Имя / Никнейм
                            </label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                autofocus
                                class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 transition-all @error('name') border-red-500 @enderror"
                            >
                            @error('name')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-5">
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 transition-all @error('email') border-red-500 @enderror"
                            >
                            @error('email')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Пароль -->
                        <div class="mb-5">
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                Пароль
                            </label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 transition-all @error('password') border-red-500 @enderror"
                            >
                            @error('password')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Подтверждение пароля -->
                        <div class="mb-6">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-300 mb-2">
                                Повторите пароль
                            </label>
                            <input
                                id="password-confirm"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 transition-all"
                            >
                        </div>

                        <!-- Кнопка регистрации -->
                        <button
                            type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-medium rounded-lg shadow-lg shadow-purple-900/30 transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-purple-500/40"
                        >
                            Зарегистрироваться
                        </button>
                    </form>

                    <!-- Ссылка на вход -->
                    <div class="mt-8 text-center text-sm">
                        <p class="text-gray-400">
                            Уже есть аккаунт?
                            <a href="{{ route('login') }}" class="text-purple-400 hover:text-purple-300 font-medium transition-colors">
                                Войти
                            </a>
                        </p>
                    </div>

                    <!-- Маленький текст о согласии -->
                    <p class="mt-6 text-center text-xs text-gray-500">
                        Регистрируясь, вы соглашаетесь с
                        <a href="#" class="text-gray-400 hover:text-gray-300">Условиями использования</a>
                        и
                        <a href="#" class="text-gray-400 hover:text-gray-300">Политикой конфиденциальности</a>
                    </p>
                </div>
            </div>

            <p class="mt-6 text-center text-xs text-gray-600">
                © {{ date('Y') }} VideoHub • Baku
            </p>
        </div>
    </div>

@endsection