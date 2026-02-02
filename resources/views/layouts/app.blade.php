<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Моё приложение')</title>

    <!-- Подключение Tailwind и ваших скриптов через Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 antialiased">

<!-- Header -->
<header class="bg-gray-900 border-b border-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Логотип / название проекта -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-white tracking-tight">
                My App
            </a>

            <!-- Навигация (можно расширить) -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                   class="text-gray-300 hover:text-white transition font-medium">
                    Главная
                </a>
                <a href="#"
                   class="text-gray-300 hover:text-white transition font-medium">
                    Пользователи
                </a>
                <a href="#"
                   class="text-gray-300 hover:text-white transition font-medium">
                    О проекте
                </a>
            </nav>

            <!-- Правая часть (авторизация / профиль) -->
            <div class="flex items-center space-x-4">
                @guest
<!-- {{--                    <a href="{{ route('login') }}" --}} -->
                    <a href="#"
                       class="text-gray-300 hover:text-white transition">
                        Войти
                    </a>
<!-- {{--                    <a href="{{ route('register') }}"--}} -->
                    <a href="#"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                        Регистрация
                    </a>
                @else
                    <span class="text-gray-300">
                            {{ auth()->user()->name }}
                        </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="text-gray-300 hover:text-white transition">
                            Выйти
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</header>

<!-- Основной контент -->
<main class="flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-900 border-t border-gray-800 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-gray-400">
        <p>© {{ date('Y') }} My App — все права защищены</p>
        <p class="mt-1">
            Сделано с ❤️ на Laravel + Tailwind CSS
        </p>
    </div>
</footer>

</body>
</html>