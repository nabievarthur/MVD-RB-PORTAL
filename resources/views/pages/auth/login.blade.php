@extends('layouts.base-layout')

@section('content')
    <div class="bg-white dark:bg-gray-900 bg-opacity-90 rounded-lg shadow-xl p-8 max-w-md w-full space-y-6">

        <h1 class="text-3xl font-bold text-center dark:text-white text-gray-800">Вход в систему</h1>

        <form method="POST" action="{{route('authenticate')}}" class="space-y-4">
            @csrf
            <div>
                <label for="login" class="block text-sm font-medium dark:text-white text-gray-700">Логин</label>
                <input
                    type="text"
                    id="login"
                    name="login"
                    class="mt-1 block w-full px-3 py-2 dark:bg-gray-800 border dark:text-white border-gray-300 dark:border-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm @error('login') border-red-400 @enderror"
                    placeholder="Введите ваш логин"
                    required
                />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium dark:text-white text-gray-700">Пароль</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="mt-1 block w-full px-3 py-2 dark:bg-gray-800 border dark:text-white border-gray-300 dark:border-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm @error('password') border-red-400 @enderror"
                    placeholder="Введите ваш пароль"
                    required
                />
            </div>
            @error('login')
            <p class="text-center font-bold font-semibold mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
            <button
                type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Войти
            </button>
        </form>

        <!-- Ссылка на восстановление пароля -->
        <div class="text-center">
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                Забыли пароль?
            </a>
        </div>
    </div>
@endsection
