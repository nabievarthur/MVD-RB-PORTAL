@extends('layouts.base-layout')

@section('title', '- главная')

@section('content')
    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">
        <div class="border-b border-b-gray-200 dark:border-b-gray-600 flex justify-between items-center py-4 mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold text-black/80 dark:text-white mr-4">Новости</h1>
                <a href="{{ route('news.create') }}">
                        <button type="button"
                                class="text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Создать новость
                        </button>
                </a>
            </div>
            <div>
                <form method="GET" action="{{ route('home') }}" class="flex justify-between items-center">
                    <input
                        type="text"
                        name="q"
                        class="mr-4 block w-full px-3 py-2 dark:bg-gray-800 border dark:text-white border-gray-300 dark:border-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        placeholder="Поиск"
                        value="{{ request()->input('q') }}"
                    />
                    @if(request()->has('q'))
                        <a href="{{ route('home') }}"
                           class="mr-2 text-white bg-gradient-to-r from-emerald-500 to-cyan-800 hover:from-emerald-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">
                            Отмена
                        </a>
                    @endif
                    <button type="submit"
                            class="text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Найти
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col space-y-4">
            @forelse($news as $shortNews)
                <x-news-min :news="$shortNews"/>
            @empty
                @if(request()->has('q'))
                    <p class="mt-50 text-gray-400 text-2xl text-center">По запросу {{request()->input('q')}} ничего не найдено</p>
                @else
                <p class="mt-50 text-gray-400 text-2xl text-center">Новостей нет</p>
                @endif
            @endforelse

            {{$news->withQueryString()->links()}}
        </div>
    </div>
@endsection
