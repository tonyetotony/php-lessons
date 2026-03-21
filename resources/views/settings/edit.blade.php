@extends('layouts.main')

@section('content')

    <div class="min-h-screen bg-gray-950 text-gray-100 pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">

            <!-- Заголовок -->
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Редактирование группы настроек</h1>
                    <p class="mt-2 text-gray-400">Группа «{{ $setting->name }}» и её параметры</p>
                </div>
                <a href="{{ route('settings.index') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg text-sm font-medium text-gray-300 hover:text-white transition-colors">
                    ← Назад к списку
                </a>
            </div>

            <form method="POST" action="{{ route('settings.update', $setting) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Основная информация о группе -->
                <div
                    class="bg-gray-900/70 backdrop-blur-xl border border-gray-800 rounded-2xl p-8 shadow-xl shadow-purple-950/20">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                                Название группы <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $setting->name) }}" required
                                   class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 @error('name') border-red-500 @enderror"
                                   placeholder="Например: Настройки плеера">
                            @error('name')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-300 mb-2">
                                Родительская группа
                            </label>
                            <select name="parent_id" id="parent_id"
                                    class="w-full px-4 py-3 bg-gray-800/60 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500/30 appearance-none @error('parent_id') border-red-500 @enderror">
                                <option value="">— Корневая группа (без родителя) —</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ old('parent_id', $setting->parent_id) == $parent->id ? 'selected' : '' }}
                                        {{ $parent->id == $setting->id ? 'disabled' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                               {{ old('is_active', $setting->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 rounded border-gray-600 text-purple-600 focus:ring-purple-500 bg-gray-800">
                        <label for="is_active" class="ml-3 text-gray-300 font-medium">
                            Группа активна
                        </label>
                    </div>
                </div>

                <!-- Блок с динамическими настройками -->
                <div
                    class="bg-gray-900/70 backdrop-blur-xl border border-gray-800 rounded-2xl p-8 shadow-xl shadow-purple-950/20">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold">Boolean-настройки (ключ → вкл/выкл)</h2>
                        <button type="button" id="add-setting"
                                class="inline-flex items-center px-4 py-2 bg-purple-600/30 hover:bg-purple-600/50 border border-purple-600/40 rounded-lg text-sm font-medium text-purple-300 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                            Добавить параметр
                        </button>
                    </div>

                    <div id="settings-container" class="space-y-4">
                        @if(old('keys') && is_array(old('keys')))
                            @foreach(old('keys') as $index => $key)
                                <div
                                    class="setting-row flex flex-col sm:flex-row sm:items-end gap-4 bg-gray-800/40 p-4 rounded-lg border border-gray-700">
                                    <div class="flex-1">
                                        <label class="block text-sm text-gray-400 mb-1">Название (label)</label>
                                        <input type="text" name="labels[]" value="{{ old("labels.$index") }}" required
                                               class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:border-purple-500 focus:ring-purple-500/30"
                                               placeholder="Автоматически воспроизводить следующее видео">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm text-gray-400 mb-1">Ключ (техническое имя)</label>
                                        <input type="text" name="keys[]" value="{{ $key }}" required
                                               class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:border-purple-500 focus:ring-purple-500/30"
                                               placeholder="autoplay_next_video">
                                    </div>
                                    <div class="w-24 sm:w-auto">
                                        <label class="block text-sm text-gray-400 mb-1">Значение</label>
                                        <label class="relative inline-flex items-center cursor-pointer mt-1.5">

                                            <!-- Скрытое поле по умолчанию = 0 -->
                                            <input type="hidden" name="values[{{$index}}]" value="0">

                                            <input type="checkbox" name="values[{{$index}}]" value="1"
                                                   {{ old("values.$index") ? 'checked' : '' }} class="sr-only peer">

                                            <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-purple-500/40 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                        </label>
                                    </div>
                                    <button type="button"
                                            class="remove-setting text-red-400 hover:text-red-300 transition-colors self-end sm:self-center">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            @foreach($setting->settings ?? [] as $key => $value)

                                <div
                                    class="setting-row flex flex-col sm:flex-row sm:items-end gap-4 bg-gray-800/40 p-4 rounded-lg border border-gray-700">
                                    <div class="flex-1">
                                        <label class="block text-sm text-gray-400 mb-1">Название (label)</label>
                                        <input type="text" name="labels[]"
                                               value="{{ old('labels.' . $loop->index, $value['label']) }}" required
                                               class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:border-purple-500 focus:ring-purple-500/30">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm text-gray-400 mb-1">Ключ (техническое имя)</label>
                                        <input type="text" name="keys[]"
                                               value="{{ old('keys.' . $loop->index, $value['key']) }}" required
                                               class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:border-purple-500 focus:ring-purple-500/30"
                                               placeholder="autoplay_next_video">
                                    </div>
                                    <div class="w-24 sm:w-auto">
                                        <label class="block text-sm text-gray-400 mb-1">Значение</label>
                                        <label class="relative inline-flex items-center cursor-pointer mt-1.5">
                                            <!-- !!! Важно - скрытое поле 0 -->
                                            <input type="hidden" name="values[${index}]" value="0">

                                            <input type="checkbox" name="values[${index}]" value="1" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-purple-500/40 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                        </label>
                                    </div>
                                    <button type="button"
                                            class="remove-setting text-red-400 hover:text-red-300 transition-colors self-end sm:self-center">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @error('keys.*')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    @error('labels.*')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    @error('values.*')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                                <!-- скрытый блок с настройками дочерней группы (только просмотр или редактирование) -->
                                <div id="child-{{ $child->id }}" class="hidden px-6 pb-6 pt-2">
                                    @if($child->settings && count($child->settings) > 0)
                                        <div class="space-y-4">
                                            @foreach($child->settings as $key => $value)
                                                <div
                                                    class="flex items-center justify-between py-2 border-b border-gray-700 last:border-0">
                                                    <div>
                                                        <div class="font-medium">{{ $value['label'] }}</div>
                                                        <div class="text-sm text-gray-400">значение:
                                                            <strong>{{ $value['value'] ? 'вкл' : 'выкл' }}</strong>
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="text-xs px-2.5 py-1 rounded-full {{ $value['value'] ? 'bg-green-900/40 text-green-400' : 'bg-red-900/40 text-red-400' }}">
                                        {{ $value['value'] ? 'активно' : 'выключено' }}
                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 italic py-4">В этой группе пока нет параметров</p>
                                    @endif
                                </div>
                            </div>


                <!-- Кнопки -->
                <div class="flex justify-end gap-4 pt-6">
                    <a href="{{ route('settings.index') }}"
                       class="px-6 py-3 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg font-medium text-gray-300 hover:text-white transition-colors">
                        Отмена
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 rounded-lg font-medium text-white shadow-lg shadow-purple-900/30 transition-all transform hover:scale-[1.02]">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('settings-container');
            const addBtn = document.getElementById('add-setting');
            let index = {{ old('keys') ? count(old('keys')) : ($setting->settings ? count($setting->settings, true) : 0) }};

            addBtn.addEventListener('click', function () {
                const row = document.createElement('div');
                row.className = 'setting-row flex flex-col sm:flex-row sm:items-end gap-4 bg-gray-800/40 p-4 rounded-lg border border-gray-700';
                row.innerHTML = `
                    <div class="flex-1">
                        <label class="block text-sm text-gray-400 mb-1">Название (label)</label>
                        <input type="text" name="labels[]" required
                               class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:border-purple-500 focus:ring-purple-500/30"
                               placeholder="Например: Показывать субтитры">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm text-gray-400 mb-1">Ключ (техническое имя)</label>
                        <input type="text" name="keys[]" required
                               class="w-full px-4 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:border-purple-500 focus:ring-purple-500/30"
                               placeholder="show_subtitles">
                    </div>
                   <div class="w-24 sm:w-auto">
        <label class="block text-sm text-gray-400 mb-1">Значение</label>
        <label class="relative inline-flex items-center cursor-pointer mt-1.5">
                    <!-- !!! Важно - скрытое поле 0 -->
                    <input type="hidden" name="values[${index}]" value="0">

                    <input type="checkbox" name="values[${index}]" value="1" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-purple-500/40 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                </label>
            </div>
                    <button type="button" class="remove-setting text-red-400 hover:text-red-300 transition-colors self-end sm:self-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(row);
                index++;
            });

            container.addEventListener('click', function (e) {
                if (e.target.closest('.remove-setting')) {
                    e.target.closest('.setting-row').remove();
                }
            });
        });
    </script>

@endsection