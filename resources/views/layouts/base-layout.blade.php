<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/logo.svg"/>
    <script>
        (() => {
            const theme = localStorage.getItem('theme');
            const isDark = theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
            const html = document.documentElement;
            html.classList.toggle('dark', isDark);

            // Создаём временной стиль, чтобы скрыть ненужную иконку
            const style = document.createElement('style');
            style.textContent = isDark
                ? '#moon-icon { display: none; } #sun-icon { display: inline; }'
                : '#moon-icon { display: inline; } #sun-icon { display: none; }';
            document.head.appendChild(style);
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>МВД по РБ @yield('title')</title>
</head>
<body class="bg-gradient-to-br from-blue-600 to-red-600 min-h-screen">
<div class="flex flex-col min-h-screen">
    @include('components.navbar')
    <main class="flex-1 flex items-center justify-center mb-2">
        @yield('content')
    </main>
    @include('components.messagebox')
    @include('components.footer')
</div>
<script>
    const toggleButton = document.getElementById('theme-toggle');
    const htmlTag = document.documentElement;
    const moonIcon = document.getElementById('moon-icon');
    const sunIcon = document.getElementById('sun-icon');

    // Функция для установки темы
    function setTheme(theme) {
        if (theme === 'dark') {
            htmlTag.classList.add('dark');
            moonIcon.style.display = 'none';
            sunIcon.style.display = 'inline';
        } else {
            htmlTag.classList.remove('dark');
            moonIcon.style.display = 'inline';
            sunIcon.style.display = 'none';
        }
        localStorage.setItem('theme', theme);
    }

    // Обработчик кнопки
    toggleButton.addEventListener('click', () => {
        const currentTheme = htmlTag.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });

    // При загрузке страницы: читаем тему из localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            setTheme(savedTheme);
        }
    });
</script>


</body>
</html>
