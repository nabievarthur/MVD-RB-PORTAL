@props([
    'route', // Обязательный параметр - имя маршрута
    'text', // Обязательный параметр - текст ссылки
    'icon', // SVG-иконка (в виде строки)
    'activeClass' => 'bg-gray-700 text-white', // Классы для активного состояния
    'inactiveClass' => 'text-gray-300 hover:text-white hover:bg-gray-700', // Классы для неактивного состояния
])

<li>
    <a href="{{ route($route) }}"
       class="flex items-center px-4 py-2 rounded transition {{ Route::is($route) ? $activeClass : $inactiveClass }}">
        {!! $icon !!} <!-- Вставка SVG-иконки -->
        <span class="ml-3">{{ $text }}</span>
    </a>
</li>
