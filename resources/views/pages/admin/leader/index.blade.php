@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full">
        <!-- Блок создания руководителя (1/3 ширины) -->
{{--        <div class="w-1/3 bg-gray-800 rounded-lg shadow-md ml-4 mt-4 mb-4 p-4 overflow-auto">--}}
{{--            <h2 class="text-xl font-bold text-gray-200 text-center">Добавление нового руководителя</h2>--}}
{{--            <form action="{{route('admin.leader.store')}}" method="POST" class="w-full" enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--                <div class="space-y-4">--}}
{{--                    <!-- ФИО -->--}}
{{--                    <div>--}}
{{--                        <label for="full_name" class="block text-sm font-medium text-gray-400">ФИО</label>--}}
{{--                        <input--}}
{{--                            value="{{ old('full_name') }}"--}}
{{--                            type="text"--}}
{{--                            id="full_name"--}}
{{--                            name="full_name"--}}
{{--                            placeholder="Введите ФИО"--}}
{{--                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('full_name') border border-red-400 @enderror"--}}
{{--                        />--}}
{{--                        @error('full_name')--}}
{{--                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <!-- Звание -->--}}
{{--                    <div>--}}
{{--                        <label for="rank" class="block text-sm font-medium text-gray-400">Звание</label>--}}
{{--                        <input--}}
{{--                            value="{{ old('rank') }}"--}}
{{--                            type="text"--}}
{{--                            id="rank"--}}
{{--                            name="rank"--}}
{{--                            placeholder="Введите звание"--}}
{{--                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('rank') border border-red-400 @enderror"--}}
{{--                        />--}}
{{--                        @error('rank')--}}
{{--                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <!-- Должность -->--}}
{{--                    <div>--}}
{{--                        <label for="position" class="block text-sm font-medium text-gray-400">Должность</label>--}}
{{--                        <input--}}
{{--                            value="{{ old('position') }}"--}}
{{--                            type="text"--}}
{{--                            id="position"--}}
{{--                            name="position"--}}
{{--                            placeholder="Введите должность"--}}
{{--                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('position') border border-red-400 @enderror"--}}
{{--                        />--}}
{{--                        @error('position')--}}
{{--                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="priority" class="block text-sm font-medium text-gray-400">Приоритет--}}
{{--                            отображения</label>--}}
{{--                        <select--}}
{{--                            id="priority"--}}
{{--                            name="priority"--}}
{{--                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('priority') border border-red-400 @enderror"--}}
{{--                        >--}}
{{--                            <option value="" disabled selected>Выберите приоритет</option>--}}
{{--                            <option value="minister">Министр</option>--}}
{{--                            <option value="deputy_minister">Заместитель министра</option>--}}
{{--                            <option value="deputy_police_chief">Заместитель начальника полиции</option>--}}
{{--                            <option value="department_head">Прочее</option>--}}
{{--                        </select>--}}
{{--                        @error('priority')--}}
{{--                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="file" class="block text-sm font-medium text-gray-400">Изображение</label>--}}
{{--                        <input--}}
{{--                            value="{{ old('file') }}"--}}
{{--                            type="file"--}}
{{--                            id="file"--}}
{{--                            name="file"--}}
{{--                            placeholder="Введите отчество"--}}
{{--                            class="file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-600/50 file:text-indigo-500 hover:file:bg-gray-600 mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('file') border border-red-400 @enderror"--}}
{{--                        />--}}
{{--                        @error('file')--}}
{{--                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <!-- Submit Button -->--}}
{{--                    <div class="pt-2">--}}
{{--                        <button type="submit"--}}
{{--                                class="w-full bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50 cursor-pointer transition flex items-center justify-center space-x-2">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"--}}
{{--                                 class="bi bi-person-plus" viewBox="0 0 16 16">--}}
{{--                                <path--}}
{{--                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>--}}
{{--                                <path fill-rule="evenodd"--}}
{{--                                      d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>--}}
{{--                            </svg>--}}
{{--                            <span>Добавить</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}

        <!-- Блок с поиском и таблицей (2/3 ширины) -->
        <div class="w-1/3 bg-gray-800 rounded-lg shadow-md ml-4 mt-4 mb-4 p-4 overflow-auto">
            <h2 class="text-xl font-bold text-gray-200 text-center">Добавление нового руководителя</h2>
            <form action="{{route('admin.leader.store')}}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <!-- ФИО -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-400">ФИО</label>
                        <input
                            value="{{ old('full_name') }}"
                            type="text"
                            id="full_name"
                            name="full_name"
                            placeholder="Введите ФИО"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('full_name') border border-red-400 @enderror"
                        />
                        @error('full_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Звание -->
                    <div>
                        <label for="rank" class="block text-sm font-medium text-gray-400">Звание</label>
                        <input
                            value="{{ old('rank') }}"
                            type="text"
                            id="rank"
                            name="rank"
                            placeholder="Введите звание"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('rank') border border-red-400 @enderror"
                        />
                        @error('rank')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Должность -->
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-400">Должность</label>
                        <input
                            value="{{ old('position') }}"
                            type="text"
                            id="position"
                            name="position"
                            placeholder="Введите должность"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('position') border border-red-400 @enderror"
                        />
                        @error('position')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-400">Приоритет
                            отображения</label>
                        <select
                            id="priority"
                            name="priority"
                            class="mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('priority') border border-red-400 @enderror"
                        >
                            <option value="" disabled selected>Выберите приоритет</option>
                            <option value="minister" {{old('priority') === 'minister' ? "selected" : ""}}>Министр</option>
                            <option value="deputy_minister" {{old('priority') === 'deputy_minister' ? "selected" : ""}}>Заместитель министра</option>
                            <option value="deputy_police_chief" {{old('priority') === 'deputy_police_chief' ? "selected" : ""}}>Заместитель начальника полиции</option>
                            <option value="department_head" {{old('priority') === 'department_head' ? "selected" : ""}}>Прочее</option>
                        </select>
                        @error('priority')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Контейнер для предпросмотра и обрезки -->
                    <div id="image-cropper-container" class="hidden">
                        <div class="mb-4">
                            <img id="image-preview" class="max-w-full max-h-64">
                        </div>
                        <div class="flex space-x-2 mb-4">
                            <button type="button" id="crop-btn" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Обрезать</button>
                            <button type="button" id="cancel-crop-btn" class="bg-gray-600 text-white px-3 py-1 rounded text-sm">Отмена</button>
                        </div>
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-400">Изображение</label>
                        <input
                            type="file"
                            id="file"
                            accept="image/*"
                            class="file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-600/50 file:text-indigo-500 hover:file:bg-gray-600 mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('file') border border-red-400 @enderror"
                        />
                        <!-- Скрытое поле для хранения обрезанного изображения -->
                        <input type="hidden" id="cropped-image-data" name="file">
                        @error('file')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full bg-green-600/50 text-white px-4 py-2 rounded hover:bg-green-700/50 cursor-pointer transition flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                <path fill-rule="evenodd"
                                      d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                            <span>Добавить</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="w-2/3 bg-gray-800 rounded-lg shadow-md m-4 p-4">
            <!-- Блок поиска -->

            <form method="GET" action="{{ route('admin.user.index') }}" class="grid grid-cols-3 gap-4 mb-4">
                <!-- Первая строка: Логин, Фамилия, Имя -->
                <input
                    name="login"
                    value="{{ request()->input('login') }}"
                    type="text"
                    placeholder="Поиск по логину..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-full"
                />
                <input
                    name="full_name"
                    value="{{ request()->input('full_name') }}"
                    type="text"
                    placeholder="Поиск по фамилии..."
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

                    <a href="{{ route('admin.user.index') }}" class="w-full">
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
                        <th class="py-3 px-4 text-left font-semibold">ФИО</th>
                        <th class="py-3 px-4 text-left font-semibold">Звание</th>
                        <th class="py-3 px-4 text-left font-semibold">Должность</th>
                        <th class="py-3 px-4 text-left font-semibold">Позиция</th>
                        <th class="py-3 px-4 text-center font-semibold">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($leaders as $leader)
                        <tr class="border-b border-gray-600 hover:bg-gray-600 transition-colors">
                            <td class="py-3 px-4">{{$leader->id}}</td>
                            <td class="py-3 px-4">{{$leader->full_name}}</td>
                            <td class="py-3 px-4">{{$leader->rank}}</td>
                            <td class="py-3 px-4">{{$leader->position}}</td>
                            <td class="py-3 px-4">{{$leader->priority}}</td>
                            <td class="py-3 px-4 space-x-2 flex justify-center">
                                <a href="{{route('admin.leader.edit', $leader->id)}}"
                                   class="bg-indigo-500/50 text-white px-3 py-1 rounded cursor-pointer hover:bg-indigo-800/50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-pen" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                    </svg>
                                    <span class="text-sm">Редактировать</span>
                                </a>
                                <button
                                    onclick="openModal('{{ route('admin.leader.destroy', $leader->id) }}', 'этого руководителя')"
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
                {{$leaders->withQueryString()->links()}}
            </div>

            <div class="backdrop-blur-sm bg-white/30 ...">

            </div>
        </div>
    </div>
@endsection
