@extends('layouts.base-layout')

@section('title', '- вход')

@section('content')
    <div id="login-container" class="bg-white dark:bg-gray-900 bg-opacity-90 rounded-lg shadow-xl p-8 max-w-md w-full space-y-6">

        <h1 class="text-3xl font-bold text-center dark:text-white text-gray-800">Вход в систему</h1>

        <form method="POST" action="{{route('authenticate')}}" class="space-y-4">
            @csrf
            <div>
                <label for="login" class="block text-sm font-medium dark:text-white text-gray-700">Логин</label>
                <input
                    type="text"
                    id="login"
                    name="login"
                    class="mt-1 block w-full px-3 py-2 dark:bg-gray-800 border dark:text-white border-gray-300 dark:border-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm @error('login') border-red-400 dark:border-red-400 @enderror"
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
                    class="mt-1 block w-full px-3 py-2 dark:bg-gray-800 border dark:text-white border-gray-300 dark:border-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm @error('password') border-red-400 dark:border-red-400 @enderror"
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
            <a href="#" id="forgot-password-link" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                Забыли логин или пароль?
            </a>
        </div>
    </div>

    <!-- Модальное окно восстановления пароля -->
    <div id="password-recovery-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
        <div class="bg-white dark:bg-gray-900 bg-opacity-90 rounded-lg shadow-xl p-8 max-w-md w-full space-y-6">
            <h2 class="text-2xl font-bold text-center dark:text-white text-gray-800">Восстановление доступа</h2>

            <div class="space-y-4">
                <p class="text-sm dark:text-gray-300 text-gray-600 text-center">
                    Для восстановления доступа к аккаунту свяжитесь с технической поддержкой:
                </p>

                <div class="space-y-3">
                    <!-- Телефон -->
                    <div class="flex items-center space-x-3 p-3 dark:bg-gray-800 bg-gray-50 rounded-md">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="dark:text-gray-300 text-gray-700">55-05</span>
                    </div>

                    <div class="flex items-center space-x-3 p-3 dark:bg-gray-800 bg-gray-50 rounded-md">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="dark:text-gray-300 text-gray-700">55-06</span>
                    </div>

                    <div class="flex items-center space-x-3 p-3 dark:bg-gray-800 bg-gray-50 rounded-md">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="dark:text-gray-300 text-gray-700">55-10</span>
                    </div>

                    <div class="flex items-center space-x-3 p-3 dark:bg-gray-800 bg-gray-50 rounded-md">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="dark:text-gray-300 text-gray-700">55-13</span>
                    </div>


                </div>

                <div class="p-3 dark:bg-gray-800 bg-gray-50 rounded-md">
                    <p class="text-xs dark:text-gray-400 text-gray-500 text-center">
                        ⏰ Рабочие дни: Пн-Пт с 8:45 до 18:15
                    </p>
                </div>
            </div>

            <div class="flex justify-center pt-2">
                <button
                    onclick="closePasswordModal()"
                    class="cursor-pointer px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-md hover:from-indigo-700 hover:to-purple-700 flex items-center space-x-2 transition-colors duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                    </svg>
                    <span>Понятно</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Функции для управления модальным окном восстановления пароля
        function openPasswordModal() {
            const modal = document.getElementById('password-recovery-modal');
            const loginContainer = document.getElementById('login-container');

            // Скрываем блок логина
            loginContainer.classList.add('hidden');
            // Показываем модальное окно
            modal.classList.remove('hidden');
        }

        function closePasswordModal() {
            const modal = document.getElementById('password-recovery-modal');
            const loginContainer = document.getElementById('login-container');

            // Скрываем модальное окно
            modal.classList.add('hidden');
            // Показываем блок логина
            loginContainer.classList.remove('hidden');
        }

        // Обработчик для ссылки "Забыли пароль?"
        document.addEventListener('DOMContentLoaded', function() {
            const forgotLink = document.getElementById('forgot-password-link');
            if (forgotLink) {
                forgotLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    openPasswordModal();
                });
            }

            // Закрытие при клике вне модального окна
            const modal = document.getElementById('password-recovery-modal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closePasswordModal();
                    }
                });
            }

            // Закрытие по ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (!modal.classList.contains('hidden')) {
                        closePasswordModal();
                    }
                }
            });
        });
    </script>
@endsection
