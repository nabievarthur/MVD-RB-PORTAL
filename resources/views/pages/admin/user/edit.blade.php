@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full justify-center bg-gray-800 rounded-lg shadow-md p-6 m-4 relative">
        <!-- Кнопка "Назад" -->
        <a href="{{ route('admin.user.index') }}"
           class="absolute top-4 right-4 bg-teal-700/50 text-white px-4 py-2 rounded hover:bg-teal-800/50 cursor-pointer transition flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                 viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            <span>Назад</span>
        </a>

        <div class="w-1/3">
            <div>
                <h2 class="text-xl font-bold text-gray-200 mb-4 text-center">Редактирование пользователя
                    № {{$user->id}}</h2>
            </div>
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="w-full flex flex-col space-y-4">
                @csrf
                @method('PATCH')
                <!-- Фамилия -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-400">Фамилия</label>
                    <input
                            value="{{ old('last_name') ?? $user->last_name }}"
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
                            value="{{ old('first_name') ?? $user->first_name }}"
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
                            value="{{ old('surname') ?? $user->surname }}"
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
                <!-- ОВД -->
                <div>
                    <label for="ovd" class="block text-sm font-medium text-gray-400">ОВД</label>
                    <select
                        id="ovd"
                        name="ovd_id"
                        class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('ovd_id') border border-red-400 @enderror"
                    >
                        <option value="" disabled selected>Выберите ОВД</option>
                        @foreach($ovd as $id => $title)
                            <option
                                value="{{ $id }}" {{ $id == $user->ovd_id ? 'selected' : '' }}>{{ $title }}
                            </option>
                        @endforeach
                    </select>
                    @error('ovd_id')
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
                                    value="{{ $id }}" {{ $id === $user->subdivision_id ? 'selected' : '' }}>{{ $title }}</option>
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
                        <option value="" selected>Пользователь</option>
                        @foreach($roles as $id => $title)
                            <option
                                    value="{{ $id }}" {{ $id === $user->role_id ? 'selected' : '' }}>{{ $title }}</option>
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
                            value="{{ old('login') ?? $user->login }}"
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
                    <label for="password" class="block text-sm font-medium text-gray-400">Новый пароль</label>
                    <input
                        type="text"
                        id="password"
                        name="password"
                        placeholder="Введите новый пароль"
                        class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('password') border border-red-400 @enderror"
                    />
                    @error('password')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-400">Повторите новый пароль</label>
                    <input
                        type="text"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Повторите новый пароль"
                        class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                    />
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50 cursor-pointer transition flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                        </svg>
                        <span>Сохранить</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
