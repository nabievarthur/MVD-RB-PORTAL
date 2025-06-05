@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full">
        <!-- Блок создания пользователя (1/3 ширины) -->
        <div class="w-1/3 bg-gray-800 rounded-lg shadow-md ml-4 mt-4 mb-4 p-6">
            <h2 class="text-xl font-bold text-gray-200 mb-4 text-center">Создание нового пользователя</h2>
            <form action="#" method="POST" class="w-full">
                @csrf
                <div class="space-y-4">
                    <!-- Full Name Input -->
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Фамилия -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-400">Фамилия</label>
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                placeholder="Введите фамилию"
                                class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                                required
                            />
                        </div>

                        <!-- Имя -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-400">Имя</label>
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                placeholder="Введите имя"
                                class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                                required
                            />
                        </div>

                        <!-- Отчество -->
                        <div>
                            <label for="middle_name" class="block text-sm font-medium text-gray-400">Отчество</label>
                            <input
                                type="text"
                                id="middle_name"
                                name="middle_name"
                                placeholder="Введите отчество"
                                class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                            />
                        </div>
                    </div>

                    <!-- Подразделение -->
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-400">Подразделение</label>
                        <select
                            id="department"
                            name="department"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                            required
                        >
                            <option value="" disabled selected>Выберите подразделение</option>
                            @foreach($subdivisions as $id => $title)
                            <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Роль -->
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-400">Роль</label>
                        <select
                            id="department"
                            name="department"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                        >
                            <option value="" selected>Пользователь</option>
                            @foreach($roles as $id => $title)
                                <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Login Input -->
                    <div>
                        <label for="login" class="block text-sm font-medium text-gray-400">Логин</label>
                        <input
                            type="text"
                            id="login"
                            name="login"
                            placeholder="Введите логин"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                            required
                        />
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-400">Пароль</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Введите пароль"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                            required
                        />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50 cursor-pointer transition flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                            <span>Cоздать</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Блок с поиском и таблицей (2/3 ширины) -->
        <div class="w-2/3 bg-gray-800 rounded-lg shadow-md m-4 p-6">
            <!-- Header with Search and Add User Button -->
            <div class="flex justify-between items-center mb-4">
                <div>
                    <input
                        type="text"
                        placeholder="Поиск по логину..."
                        class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-64 mr-4"
                    />
                    <input
                        type="text"
                        placeholder="Поиск по ФИО..."
                        class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-64"
                    />
                </div>
                <div>
                    <a href="{{route('admin.user.create')}}">
                        <button class="bg-teal-700/50 text-white px-4 py-2 rounded hover:bg-teal-800/50 cursor-pointer transition flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                            <span>Найти</span>
                        </button>
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-gray-700 rounded-lg overflow-hidden">
                <table class="w-full text-gray-300">
                    <thead>
                    <tr class="border-b border-gray-600 bg-gray-900/80">
                        <th class="py-3 px-4 text-left font-semibold">ID</th>
                        <th class="py-3 px-4 text-left font-semibold">Логин</th>
                        <th class="py-3 px-4 text-left font-semibold">ФИО</th>
                        <th class="py-3 px-4 text-left font-semibold">Роль</th>
                        <th class="py-3 px-4 text-left font-semibold">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-600 hover:bg-gray-600 transition-colors">
                            <td class="py-3 px-4">{{$user->id}}</td>
                            <td class="py-3 px-4">{{$user->login}}</td>
                            <td class="py-3 px-4">{{$user->full_name}}</td>
                            <td class="py-3 px-4">{{$user->role_names}}</td>
                            <td class="py-3 px-4 space-x-2 flex">
                                <button class="bg-indigo-500/50 text-white px-3 py-1 rounded cursor-pointer hover:bg-indigo-800/50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                    </svg>
                                    <span>Редактировать</span>
                                </button>
                                <button class="bg-red-600/50 text-white px-3 py-1 rounded cursor-pointer hover:bg-red-800/50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                    <span>Удалить</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{$users->withQueryString()->links()}}
            </div>
        </div>
    </div>
@endsection
