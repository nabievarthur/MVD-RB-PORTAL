@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full justify-center bg-gray-800 rounded-lg shadow-md p-6 m-4 relative">
        <!-- Кнопка "Назад" -->
        <a href="{{ route('admin.ovd.index') }}"
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
                <h2 class="text-xl font-bold text-gray-200 mb-4 text-center">Редактирование ОВД
                    № {{$ovd->id}}</h2>
            </div>
            <form action="{{ route('admin.ovd.update', $ovd->id) }}" method="POST" class="w-full flex flex-col space-y-4">
                @csrf
                @method('PATCH')
                <!-- Название -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-400">Название ОВД</label>
                    <input
                            value="{{ old('title') ?? $ovd->title }}"
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Введите название"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('title') border border-red-400 @enderror"
                    />
                    @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Код ОВД -->
                <div>
                    <label for="cod_ovd" class="block text-sm font-medium text-gray-400">Код ОВД</label>
                    <input
                            value="{{ old('cod_ovd') ?? $ovd->cod_ovd }}"
                            type="number"
                            id="cod_ovd"
                            name="cod_ovd"
                            placeholder="Введите код ОВД"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('cod_ovd') border border-red-400 @enderror"
                    />
                    @error('cod_ovd')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
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
