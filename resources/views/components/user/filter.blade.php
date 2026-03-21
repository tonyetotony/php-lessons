<?php
$settings = [];
if (is_object($setting) && property_exists($setting, 'settings')) {
    $settings = (array) $setting->settings;
}
$nameIsActiveFilter = array_filter($settings, function ($setting) {
    if ($setting['key'] == 'name' && $setting['value'] == 1) {
        return true;
    }
});

$emailIsActiveFilter = array_filter($settings, function ($setting) {
    if ($setting['key'] == 'email' && $setting['value'] == 1) {
        return true;
    }
});

$statusIsActiveFilter = array_filter($settings, function ($setting) {
    if ($setting['key'] == 'status' && $setting['value'] == 1) {
        return true;
    }
});

$slugIsActiveFilter = array_filter($settings, function ($setting) {
    if ($setting['key'] == 'slug' && $setting['value'] == 1) {
        return true;
    }
});
?>
    <!-- Фильтры -->
<div class="mb-8">
    <form method="GET" action="{{ route('users.index') }}" id="filters-form"
          class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 border border-gray-200 dark:border-gray-700">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

            @if(!empty($nameIsActiveFilter))
                <!-- Имя -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Имя
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ request('name') }}"
                           placeholder="Введите имя..."
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            @endif

            @if(!empty($slugIsActiveFilter))
                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Slug
                    </label>
                    <input type="text"
                           name="slug"
                           id="slug"
                           value="{{ request('slug') }}"
                           placeholder="Введите slug..."
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            @endif

            @if(!empty($emailIsActiveFilter))
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email
                    </label>
                    <input type="text"
                           name="email"
                           id="email"
                           value="{{ request('email') }}"
                           placeholder="Введите email..."
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            @endif

            <!-- Дата регистрации: от -->
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Дата от
                </label>
                <input type="date"
                       name="date_from"
                       id="date_from"
                       value="{{ request('date_from') }}"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            </div>

            <!-- Дата регистрации: до -->
            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Дата до
                </label>
                <input type="date"
                       name="date_to"
                       id="date_to"
                       value="{{ request('date_to') }}"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            </div>

        </div>

        <div class="mt-6 flex flex-wrap items-center gap-4">

            @if(!empty($statusIsActiveFilter))
                <!-- Статус -->
                <div>
                    <label for="active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Статус
                    </label>
                    <select name="active"
                            id="active"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Все</option>
                        <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Активен</option>
                        <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Не активен</option>
                    </select>
                </div>
            @endif

            <!-- Кнопки -->
            <div class="flex gap-3">
                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                    Применить
                </button>

                @if(request()->hasAny(['name', 'slug', 'email', 'date_from', 'date_to', 'active']))
                    <a href="{{ route('users.index') }}"
                       class="px-5 py-2 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition">
                        Очистить
                    </a>
                @endif
            </div>

        </div>
    </form>
</div>