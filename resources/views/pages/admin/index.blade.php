@extends('layouts.admin-layout')

@section('content')
<main class="flex-1 p-8 overflow-y-auto bg-gray-900">
    <header class="mb-8">
        <h2 class="text-3xl font-bold text-gray-200">Главная</h2>
    </header>
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Карточка с количеством пользователей -->
        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-300">Пользователи</h3>
            <p class="text-4xl font-bold text-white mt-2">450</p>
            <p class="text-gray-400 mt-2">Зарегистрированных пользователей</p>
        </div>
        <!-- Карточка с количеством новостей -->
        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-300">Новости</h3>
            <p class="text-4xl font-bold text-white mt-2">120</p>
            <p class="text-gray-400 mt-2">Опубликованных новостей</p>
        </div>
        <!-- Карточка с активными ролями -->
        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-300">Роли</h3>
            <p class="text-4xl font-bold text-white mt-2">5</p>
            <p class="text-gray-400 mt-2">Активных ролей</p>
        </div>
    </section>
    <section class="mt-8">
        <h3 class="text-2xl font-bold text-gray-200 mb-4">Последние действия</h3>
        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
            <ul class="space-y-4">
                <li class="text-gray-300">
                    <span class="font-semibold">Пользователь:</span> JohnDoe создал новость "Новый продукт"
                </li>
                <li class="text-gray-300">
                    <span class="font-semibold">Пользователь:</span> Admin изменил роль пользователя JaneDoe
                </li>
                <li class="text-gray-300">
                    <span class="font-semibold">Пользователь:</span> JaneDoe удалила новость "Старый продукт"
                </li>
            </ul>
        </div>
    </section>
</main>
@endsection
