@extends('layouts.base-layout')

@section('title', '- сервисы')

@section('content')
    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">
        <!-- Блок для изображения -->
        <div class="mt-20 flex justify-center items-center h-[600px] w-[400px] mx-auto bg-gray-200 dark:bg-gray-800 rounded-lg overflow-hidden">
            <img
                class="h-full w-full object-cover object-top rounded-lg"
                src="{{ asset('images/technical/technicalworks.jpg') }}"
                alt="технические работы">
        </div>
    </div>
@endsection
