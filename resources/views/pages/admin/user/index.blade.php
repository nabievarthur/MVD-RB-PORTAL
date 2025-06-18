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

                    <div class="pt-2">
                        <button
                            id="generate-password"
                            type="button"
                            class="w-full bg-yellow-600/50 text-white px-4 py-2 rounded hover:bg-yellow-700/50 cursor-pointer transition flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-key" viewBox="0 0 16 16">
                                <path
                                    d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                            </svg>
                            <span>Сгенерировать пароль</span>
                        </button>
                    </div>
                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-400">Пароль</label>
                        <input
                            type="text"
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
                            type="text"
                            id="password_confirmation"
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
            <!-- Блок поиска -->

            <form method="GET" action="{{ route('admin.user.index') }}" class="grid grid-cols-3 gap-4 mb-4">
                <!-- Первая строка: Логин, Фамилия, Имя -->
                <input
                    name="login"
                    value="{{ request()->input('login') }}"
                    type="text"
                    placeholder="Поиск по логину..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                />
                <input
                    name="last_name"
                    value="{{ request()->input('last_name') }}"
                    type="text"
                    placeholder="Поиск по фамилии..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                />
                <input
                    name="first_name"
                    value="{{ request()->input('first_name') }}"
                    type="text"
                    placeholder="Поиск по имени..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                />

                <!-- Вторая строка: Отчество, Роль и Кнопка "Найти" -->
                <input
                    name="surname"
                    value="{{ request()->input('surname') }}"
                    type="text"
                    placeholder="Поиск по отчеству..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                />
                <select
                    name="role_id"
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                >
                    <option selected disabled>Поиск по роли</option>
                    @foreach($roles as $id => $title)
                        <option
                            value="{{ $id }}" {{request()->input('role_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
                <div class="flex space-x-2">
                    <button
                        type="submit"
                        class="bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50  transition flex items-center justify-center w-full"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search mr-2" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        Найти
                    </button>

                    <a href="{{ route('admin.user.index') }}" class="w-full">
                        <button
                            type="button"
                            class="bg-indigo-500/50 text-white px-4 py-2 rounded hover:bg-indigo-800/50 transition w-full flex items-center justify-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                 class="bi bi-arrow-counterclockwise mr-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z"/>
                                <path
                                    d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466"/>
                            </svg>
                            Сбросить
                        </button>
                    </a>
                </div>

            </form>

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
                    @forelse($users as $user)
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
                    @empty
                        <td colspan="7" class="py-3 px-4 text-2xl text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <span>По вашему запросу ничего не найдено</span>
                                <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                      class="bi bi-emoji-frown" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                          <path
                                              d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.5 3.5 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.5 4.5 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                         </svg>
                                 </span>
                            </div>
                        </td>
                    @endforelse
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
                    <button
                        onclick="closeModal()"
                        class="cursor-pointer px-4 py-2 bg-indigo-500/50 rounded hover:bg-indigo-800/50 flex items-center space-x-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                        <span>Отмена</span>
                    </button>
                    <form id="delete-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="cursor-pointer px-4 py-2 bg-red-600/50 text-white rounded hover:bg-red-800/50 flex items-center space-x-2"
                        >
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
                    </form>
                </div>
            </div>
        </div>

        <!-- JS -->
        <script>
            function openModal(userId) {
                const form = document.getElementById('delete-form');
                form.action = `/admin/users/${userId}`; // Или blade: "{{ route('admin.user.destroy', '') }}/" + userId;
                document.getElementById('delete-modal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('delete-modal').classList.add('hidden');
            }

            document.getElementById('generate-password').addEventListener('click', function () {
                const password = generatePassword(8); // длина 8 символов
                document.getElementById('password').value = password;
                document.getElementById('password_confirmation').value = password;
            });

            function generatePassword(length) {
                const chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ0123456789'; // удалил I L l чтобы не путаться т.к иногда отображаются одинаково или очень похожи
                let password = '';
                for (let i = 0; i < length; i++) {
                    password += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return password;
            }
        </script>


    </div>

@endsection
