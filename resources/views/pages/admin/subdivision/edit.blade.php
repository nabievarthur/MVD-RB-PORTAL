@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full justify-center bg-gray-800 rounded-lg shadow-md p-6 m-4 relative">
        <!-- Кнопка "Назад" -->
        <a href="{{ route('admin.subdivision.index') }}"
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
                <h2 class="text-xl font-bold text-gray-200 mb-4 text-center">Редактирование Подразделения
                    № {{$subdivision->id}}</h2>
            </div>
            <form action="{{ route('admin.subdivision.update', $subdivision->id) }}" method="POST" class="w-full flex flex-col space-y-4">
                @csrf
                @method('PATCH')
                <!-- Название -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-400">Название Подразделения</label>
                    <input
                            value="{{ old('title') ?? $subdivision->title }}"
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Введите название подразделения"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('title') border border-red-400 @enderror"
                    />
                    @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50 cursor-pointer transition flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                        </svg>
                        <span>Сохранить</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
