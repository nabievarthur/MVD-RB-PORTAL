@extends('layouts.base-layout')

@section('content')
  <div class="bg-white bg-opacity-90 rounded-lg shadow-xl p-8 max-w-md w-full space-y-6">
    <!-- Заголовок формы -->
    <h1 class="text-3xl font-bold text-center text-gray-800">Вход в систему</h1>

    <!-- Форма -->
    <form class="space-y-4">
      <!-- Поле для логина -->
      <div>
        <label for="login" class="block text-sm font-medium text-gray-700">Логин</label>
        <input
          type="text"
          id="login"
          name="login"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          placeholder="Введите ваш логин"
          required
        />
      </div>

      <!-- Поле для пароля -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
        <input
          type="password"
          id="password"
          name="password"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          placeholder="Введите ваш пароль"
          required
        />
      </div>

      <!-- Кнопка входа -->
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
