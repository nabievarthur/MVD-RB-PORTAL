@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full">
        <!-- Блок создания пользователя (1/3 ширины) -->
        <div class="w-1/3 bg-gray-800 rounded-lg shadow-md ml-4 mt-4 mb-4 p-6">
            <h2 class="text-xl font-bold text-gray-200 mb-4 text-center">Создание нового пользователя</h2>
            <form action="{{route('admin.user.store')}}" method="POST" class="w-full">
                @csrf
                <div class="space-y-4">
                    <!-- Фамилия -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-400">Фамилия</label>
                        <input
                            value="{{ old('last_name') }}"
                            type="text"
                            id="last_name"
                            name="last_name"
                            placeholder="Введите фамилию"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('last_name') border border-red-400 @enderror"
                        />
                        @error('last_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Имя -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-400">Имя</label>
                        <input
                            value="{{ old('first_name') }}"
                            type="text"
                            id="first_name"
                            name="first_name"
                            placeholder="Введите имя"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('first_name') border border-red-400 @enderror"
                        />
                        @error('first_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Отчество -->
                    <div>
                        <label for="surname" class="block text-sm font-medium text-gray-400">Отчество</label>
                        <input
                            value="{{ old('surname') }}"
                            type="text"
                            id="surname"
                            name="surname"
                            placeholder="Введите отчество"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('surname') border border-red-400 @enderror"
                        />
                        @error('surname')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Подразделение -->
                    <div>
                        <label for="subdivision" class="block text-sm font-medium text-gray-400">Подразделение</label>
                        <select
                            id="subdivision"
                            name="subdivision_id"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('subdivision_id') border border-red-400 @enderror"
                        >
                            <option value="" disabled selected>Выберите подразделение</option>
                            @foreach($subdivisions as $id => $title)
                                <option
                                    value="{{ $id }}" {{ old('subdivision_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('subdivision_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Роль -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-400">Роль</label>
                        <select
                            id="role"
                            name="role_id"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('role_id') border border-red-400 @enderror"
                        >
                            <option value="" disabled selected>Выберите роль</option>
                            @foreach($roles as $id => $title)
                                <option
                                    value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Login Input -->
                    <div>
                        <label for="login" class="block text-sm font-medium text-gray-400">Логин</label>
                        <input
                            value="{{ old('login') }}"
                            type="text"
                            id="login"
                            name="login"
                            placeholder="Введите логин"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('login') border border-red-400 @enderror"
                        />
                        @error('login')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-400">Пароль</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Введите пароль"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('password') border border-red-400 @enderror"
                        />
                        @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-400">Повторите пароль</label>
                        <input
                            type="password"
                            id="password"
                            name="password_confirmation"
                            placeholder="Повторите пароль"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('password') border border-red-400 @enderror"
                        />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50 cursor-pointer transition flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                <path fill-rule="evenodd"
                                      d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                            <span>Cоздать</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Блок с поиском и таблицей (2/3 ширины) -->
        <div class="w-2/3 bg-gray-800 rounded-lg shadow-md m-4 p-4">
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
                    <a href="#">
                        <button
                            class="bg-teal-700/50 text-white px-4 py-2 rounded hover:bg-teal-800/50 cursor-pointer transition flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
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
                        <th class="py-3 px-4 text-left font-semibold">Фамилия</th>
                        <th class="py-3 px-4 text-left font-semibold">Имя</th>
                        <th class="py-3 px-4 text-left font-semibold">Отчество</th>
                        <th class="py-3 px-4 text-left font-semibold">Роль</th>
                        <th class="py-3 px-4 text-left font-semibold">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-600 hover:bg-gray-600 transition-colors">
                            <td class="py-3 px-4">{{$user->id}}</td>
                            <td class="py-3 px-4">{{$user->login}}</td>
                            <td class="py-3 px-4">{{$user->last_name}}</td>
                            <td class="py-3 px-4">{{$user->first_name}}</td>
                            <td class="py-3 px-4">{{$user->surname}}</td>
                            <td class="py-3 px-4">{{$user->role->title}}</td>
                            <td class="py-3 px-4 space-x-2 flex">
                                <a href="{{route('admin.user.edit', $user->id)}}"
                                   class="bg-indigo-500/50 text-white px-3 py-1 rounded cursor-pointer hover:bg-indigo-800/50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-pen" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                    </svg>
                                    <span>Редактировать</span>
                                </a>
                                <button
                                    onclick="openModal({{ $user->id }})"
                                    class="bg-red-600/50 text-white px-3 py-1 rounded cursor-pointer hover:bg-red-800/50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
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

            <div class="backdrop-blur-sm bg-white/30 ...">

            </div>
        </div>

        <!-- Global Modal -->
        <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4">Подтвердите удаление</h2>
                <p class="mb-4">Вы уверены, что хотите удалить этого пользователя?</p>
                <div class="flex justify-end space-x-3">
                    <button onclick="closeModal()" class="px-4 py-2 bg-indigo-500/50 rounded hover:bg-indigo-800/50">
                        Отмена
                    </button>
                    <form id="delete-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600/50 text-white rounded hover:bg-red-800/50">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <!-- JS -->
        <script>
            function openModal(userId) {
                const form = document.getElementById('delete-form');
                form.action = `/admin/users/${userId}`; // Или   blade: "{{ route('admin.user.destroy', '') }}/" + userId;
                document.getElementById('delete-modal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('delete-modal').classList.add('hidden');
            }
        </script>


    </div>

@endsection
