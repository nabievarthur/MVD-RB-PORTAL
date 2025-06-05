<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/logo.svg"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Администрирование</title>
</head>
<body class="bg-gray-900 text-white h-screen flex">

<!-- Админ навбар -->

@include('components.admin-navbar')

<!-- Admin content-->

@yield('content')

<!-- Сообщения -->
@include('components.messagebox')

</body>
</html>
