@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full">
        <!-- Блок создания ОВД (1/3 ширины) -->
        <div class="w-1/3 bg-gray-800 rounded-lg shadow-md ml-4 mt-4 mb-4 p-4 overflow-auto">
            <h2 class="text-xl font-bold text-gray-200 text-center">Создание нового ОВД</h2>
            <form action="{{route('admin.ovd.store')}}" method="POST" class="w-full">
                @csrf
                <div class="space-y-4">
                    <!-- Название ОВД -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-400">Название ОВД</label>
                        <input
                            value="{{ old('title') }}"
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Введите название ОВД"
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
                            type="number"
                            id="cod_ovd"
                            name="cod_ovd"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('kod_ovd_id') border border-red-400 @enderror"
                       />
                        <div class="mt-2 text-sm text-gray-500" id="login_help">Код ОВД должен быть уникальным</div>
                        @error('cod_ovd')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50 cursor-pointer transition flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                            </svg>
                            <span>Cоздать</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Блок с поиском и таблицей (2/3 ширины) -->
        <div class="w-2/3 bg-gray-800 rounded-lg shadow-md m-4 p-4">
            <!-- Блок поиска -->

            <form method="GET" action="{{ route('admin.ovd.index') }}" class="grid grid-cols-3 gap-4 mb-4">
                <!-- Первая строка: Название, Код -->
                <input
                    name="title"
                    value="{{ request()->input('title') }}"
                    type="text"
                    placeholder="Поиск по названию..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                />
                <input
                    name="cod_ovd"
                    value="{{ request()->input('cod_ovd') }}"
                    type="number"
                    placeholder="Поиск по коду ОВД..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                />

                <div class="flex space-x-2">
                    <button
                        type="submit"
                        class="bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50  transition flex items-center justify-center w-full"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search mr-2" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        Найти
                    </button>

                    <a href="{{ route('admin.ovd.index') }}" class="w-full">
                        <button
                            type="button"
                            class="bg-indigo-500/50 text-white px-4 py-2 rounded hover:bg-indigo-800/50 transition w-full flex items-center justify-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                 class="bi bi-arrow-counterclockwise mr-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z"/>
                                <path
                                    d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466"/>
                            </svg>
                            Сбросить
                        </button>
                    </a>
                </div>

            </form>

            <!-- Table -->
            <div class="bg-gray-700 rounded-lg overflow-hidden">
                <table class="w-full text-gray-300">
                    <thead>
                    <tr class="border-b border-gray-600 bg-gray-900/80">
                        <th class="py-3 px-4 text-left font-semibold">ID</th>
                        <th class="py-3 px-4 text-left font-semibold">Название</th>
                        <th class="py-3 px-4 text-left font-semibold">Код ОВД</th>
                        <th class="py-3 px-4 text-center font-semibold">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ovd as $oragan)
                        <tr class="border-b border-gray-600 hover:bg-gray-600 transition-colors">
                            <td class="py-3 px-4">{{$oragan->id}}</td>
                            <td class="py-3 px-4">{{$oragan->title}}</td>
                            <td class="py-3 px-4">{{$oragan->cod_ovd}}</td>
                            <td class="py-3 px-4 space-x-2 flex justify-center">
                                <a href="{{route('admin.ovd.edit', $oragan->id)}}"
                                   class="bg-indigo-500/50 text-white px-3 py-1 rounded cursor-pointer hover:bg-indigo-800/50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-pen" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                    </svg>
                                    <span class="text-sm">Редактировать</span>
                                </a>
                                <button
                                    onclick="openModal('{{ route('admin.ovd.destroy', $oragan->id) }}', 'этот ОВД')"
                                    class="bg-red-600/50 text-white px-3 py-1 rounded cursor-pointer hover:bg-red-800/50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                    <span class="text-sm">Удалить</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <td colspan="7" class="py-3 px-4 text-2xl text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <span>По вашему запросу ничего не найдено</span>
                                <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                      class="bi bi-emoji-frown" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                          <path
                                              d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.5 3.5 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.5 4.5 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                         </svg>
                                 </span>
                            </div>
                        </td>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{$ovd->withQueryString()->links()}}
            </div>

            <div class="backdrop-blur-sm bg-white/30 ...">

            </div>
        </div>

    </div>

@endsection
