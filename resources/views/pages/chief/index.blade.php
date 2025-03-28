@extends('layouts.base-layout')

@section('content')
    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">
        <div class="border-b border-b-gray-200 dark:border-b-gray-600 flex justify-between items-center py-4 mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold text-black/80 dark:text-white mr-4">Руководство МВД по Республике Башкортостан</h1>
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
          fsdfsfsf
        </div>
    </div>
@endsection
