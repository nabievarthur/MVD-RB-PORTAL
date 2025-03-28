<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.svg" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>МВД по РБ</title>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-red-600">
    <!-- Навбар -->
    @include('components.navbar')
    <!-- Контент -->
    @yield('content')
    <!-- Cообщениея-->
    @include('components.messagebox')
    <!-- Футер позже добавить -->
</body>
</html>
