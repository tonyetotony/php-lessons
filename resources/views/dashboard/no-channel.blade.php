<!-- resources/views/dashboard/no-channel.blade.php -->

@extends('layouts.main')

@section('title', 'Мой канал')

@section('content')
    <div class="min-h-screen bg-gray-950 text-gray-100 flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <!-- Иконка -->
            <div class="w-20 h-20 mx-auto mb-6 text-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h18M3 16h18" />
                </svg>
            </div>

            <!-- Заголовок и сообщение -->
            <h2 class="text-2xl font-semibold mb-4">У вас пока нет канала</h2>
            <p class="text-gray-400 mb-8">
                Создайте свой канал, чтобы начать загружать видео, расти и зарабатывать.
            </p>

            <!-- Кнопка создания канала -->
            <a href="{{ route('channels.create') }}"
               class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors shadow-lg shadow-purple-900/20">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Создать канал
            </a>
        </div>
    </div>
@endsection