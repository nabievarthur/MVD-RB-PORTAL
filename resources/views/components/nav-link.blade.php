@props([
    'route',       // обязательный параметр - имя маршрута
    'text',        // обязательный параметр - текст ссылки
    'activeClass' => 'text-blue-700', // классы для активного состояния
    'inactiveClass' => 'text-gray-900 dark:text-white', // классы для неактивного состояния
    'hoverClass' => 'hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent',
    'mobileClasses' => 'block py-2 px-3 rounded-sm', // классы для мобильного вида
    'desktopClasses' => 'md:p-0 md:dark:hover:text-blue-500 dark:border-gray-700' // классы для десктопного вида
])

<a href="{{ route($route) }}"
   class="{{ $mobileClasses }} {{ $desktopClasses }} {{ Route::is($route) ? $activeClass : $inactiveClass }} {{ $hoverClass }}">
    {{ $text }}
</a>
