@extends('layouts.admin-layout')

@section('content')
    <div class="flex w-full justify-center bg-gray-800 rounded-lg shadow-md p-6 m-4 relative">
        <!-- Кнопка "Назад" -->
        <a href="{{ route('admin.leader.index') }}"
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
                <h2 class="text-xl font-bold text-gray-200 mb-4 text-center">Редактирование руководителя <br> {{$leader->full_name}}</h2>
            </div>
            <form action="{{ route('admin.leader.update', $leader->id) }}" method="POST" class="w-full flex flex-col space-y-4">
                @csrf
                @method('PATCH')
                <!-- ФИО -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-400">ФИО</label>
                        <input
                            value="{{ old('full_name') ? old('full_name') : $leader->full_name }}"
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
                    <div class="">
                        <label for="rank" class="block text-sm font-medium text-gray-400">Звание</label>
                        <input
                            value="{{ old('rank') ? old('rank') : $leader->rank }}"
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
                            value="{{ old('position') ? old('position') : $leader->position }}"
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
                            <option value="minister" {{$leader->priority === 'Министр внутренних дел' ? "selected" : ""}}>Министр</option>
                            <option value="deputy_minister" {{$leader->priority === 'Заместитель министра' ? "selected" : ""}}>Заместитель министра</option>
                            <option value="deputy_police_chief" {{$leader->priority === 'Заместитель начальника полиции' ? "selected" : ""}}>Заместитель начальника полиции</option>
                            <option value="department_head" {{$leader->priority === 'Начальник управления и прочее' ? "selected" : ""}}>Прочее</option>
                        </select>
                        @error('priority')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-400">Изображение</label>
                        <input
                            value="{{ old('file') }}"
                            type="file"
                            id="file"
                            name="file"
                            placeholder="Введите отчество"
                            class="file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-600/50 file:text-indigo-500 hover:file:bg-gray-600 mt-1 block w-full bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition @error('file') border border-red-400 @enderror"
                        />
                        @error('file')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

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
