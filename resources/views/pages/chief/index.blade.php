@extends('layouts.base-layout')

@section('content')
    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">
        <div class="border-b border-b-gray-200 dark:border-b-gray-600 flex justify-between items-center py-4 mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold text-black/80 dark:text-white mr-4">Руководство МВД по Республике
                    Башкортостан</h1>
            </div>
            <div class="flex justify-between items-center">
                <a href="{{route('home')}}">
                    <button type="button"
                            class="text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Назад
                    </button>
                </a>
            </div>
        </div>
        <div>
            <!-- Карточка министра -->
            <div class="flex justify-center items-center mt-10">
                <div
                    class="w-72 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-200 dark:border-gray-700">
                    <!-- Фото руководителя -->
                    <div class="h-52 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <img
                            class="h-full w-full object-cover object-top"
                            src="{{asset('images/chiefs/A.A_Pryadko.jpg')}}"
                            alt="Фото руководителя">
                    </div>

                    <!-- Информация -->
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Прядко Александр
                            Александрович</h3>
                        <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">Генерал-лейтенант полиции</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">Министр внутренних дел по Республике
                            Башкортостан</p>
                    </div>
                </div>
            </div>
            <div class="mt-10 flex justify-center">
                <!-- Ряд с 4 карточками -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 justify-center">
                    <!-- Карточка 1 -->
                    <div
                        class="w-72 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-200 dark:border-gray-700">
                        <div class="h-52 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <img
                                class="h-full w-full object-cover object-top"
                                src="{{asset('images/chiefs/Saifullin.jpg')}}"
                                alt="Фото сотрудника">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Сайфуллин Артур
                                Фаридович</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">Генерал-майор полиции</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">Заместитель министра - начальник полиции</p>
                        </div>
                    </div>

                    <!-- Карточка 2 -->
                    <div
                        class="w-72 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-200 dark:border-gray-700">
                        <div class="h-52 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <img
                                class="h-full w-full object-cover object-top"
                                src="{{asset('images/chiefs/Baranov.png')}}"
                                alt="Фото сотрудника">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Петров Петр</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">Полковник юстиции</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">Начальник отдела</p>
                        </div>
                    </div>

                    <!-- Карточка 3 -->
                    <div
                        class="w-72 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-200 dark:border-gray-700">
                        <div class="h-52 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <img
                                class="h-full w-full object-cover object-top"
                                src="{{asset('images/chiefs/person3.jpg')}}"
                                alt="Фото сотрудника">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Сидоров Сидор</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">Майор</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">Старший офицер</p>
                        </div>
                    </div>

                    <!-- Карточка 4 -->
                    <div
                        class="w-72 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-200 dark:border-gray-700">
                        <div class="h-52 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <img
                                class="h-full w-full object-cover object-top"
                                src="{{asset('images/chiefs/person4.jpg')}}"
                                alt="Фото сотрудника">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Кузнецов Кузьма</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">Капитан</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">Офицер связи</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
