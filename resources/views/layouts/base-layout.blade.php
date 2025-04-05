<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/logo.svg" />
    <script>
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>МВД по РБ @yield('title')</title>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-red-600">
    <!-- Навбар -->
    @include('components.navbar')
    <!-- Контент -->
    @yield('content')
    <!-- Cообщениея-->
    @include('components.messagebox')
    <!-- Футер позже добавить -->

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
