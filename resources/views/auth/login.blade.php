@extends('layouts.main')

@section('content')

    <div class="min-h-screen bg-gray-950 flex items-center justify-center p-4">
        <!-- Фоновая градиентная подложка (можно убрать или заменить на видео/анимацию) -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-950/30 via-indigo-950/20 to-gray-950 opacity-60"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(168,85,247,0.12),transparent_40%)]"></div>
        </div>

        <div class="relative w-full max-w-md">
            <!-- Карточка логина -->
            <div class="bg-gray-900/70 backdrop-blur-xl border border-gray-800/80 rounded-2xl shadow-2xl shadow-purple-950/30 overflow-hidden">
                <!-- Верхняя часть с логотипом / приветствием -->
                <div class="px-8 pt-10 pb-6 text-center">
                    <div class="mx-auto w-16 h-16 rounded-xl bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg shadow-purple-900/40 mb-4">
                        V
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight">Вход в VideoHub</h2>
                    <p class="mt-2 text-gray-400 text-sm">
                        Войди, чтобы загружать видео, смотреть аналитику и зарабатывать
                    </p>
                </div>

                <!-- Форма -->
                <div class="px-8 pb-10">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-5">
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') ?? 'admin@mail.ru' }}"
                                required
                                autocomplete="email"
                                autofocus
                                class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 transition-all @error('email') border-red-500 @enderror"
                            >
                            @error('email')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                Пароль
                            </label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                value="password"
                                required
                                autocomplete="current-password"
                                class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 transition-all @error('password') border-red-500 @enderror"
                            >
                            @error('password')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between mb-8 text-sm">
                            <label class="flex items-center text-gray-300">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-gray-600 text-purple-600 focus:ring-purple-500 bg-gray-800"
                                >
                                <span class="ml-2">Запомнить меня</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-purple-400 hover:text-purple-300 transition-colors">
                                    Забыли пароль?
                                </a>
                            @endif
                        </div>

                        <!-- Кнопка входа -->
                        <button
                            type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-lg shadow-purple-900/30 transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-purple-500/40"
                        >
                            Войти
                        </button>
                    </form>

                    <!-- Разделитель или социальный вход (опционально) -->
                    <div class="mt-8 text-center">
                        <p class="text-gray-500 text-sm">
                            Нет аккаунта?
                            <a href="{{ route('register') }}" class="text-purple-400 hover:text-purple-300 font-medium">
                                Зарегистрироваться
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Маленькая подпись снизу (опционально) -->
            <p class="mt-6 text-center text-xs text-gray-600">
                © {{ date('Y') }} VideoHub • Baku
            </p>
        </div>
    </div>

@endsection