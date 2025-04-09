@extends('layouts.base-layout')

@section('title', '- редактирование новости')

@section('content')
    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">
        <div class="border-b border-b-gray-200 dark:border-b-gray-6 00 flex justify-between items-center py-4 mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold text-black/80 dark:text-white mr-4">Редактирование новости</h1>
            </div>
            <div class="flex justify-between items-center">
                <x-button-back/>
            </div>
        </div>
        <div>
            <form method="POST" action="#" enctype="multipart/form-data" class="flex flex-col items-center">
                @method('PATCH')
                @csrf
                <div class="w-2/3 mx-auto mb-4">
                    <label for="title"
                           class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Заголовок <span class="font-bold text-red-500">*</span></label>
                    <input
                        value="{{old('title') ? old('title') : $news['title']}}"
                        type="text"
                        id="title"
                        name="title"
                        class="block w-full px-3 py-2 dark:bg-gray-800 border dark:text-white border-gray-300 dark:border-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm @error('title') border-red-400 dark:border-red-400 @enderror"
                        placeholder="Введите заголовок новости"
                        required
                    />
                    @error('title')
                    <p class="text-center font-bold font-semibold mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-2/3 mx-auto mb-4">
                    <label for="content" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Содержание</label>
                    <textarea
                        rows="4"
                        id="content"
                        name="description"
                        class="w-full block px-3 py-2 dark:bg-gray-800 border dark:text-white border-gray-300 dark:border-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        placeholder="Введите содержание новости"
                    >{{old('description') ? old('description') : $news['description']}}</textarea>
                </div>

                @if($news->files->count() > 0)
                    <div class="w-2/3 mx-auto mb-4 file-list-wrapper">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Загруженные файлы</h2>
                        <ul class="list-disc">
                            @foreach($news->files as $file)
                                <li class="mb-2 flex items-center">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="text-indigo-600 hover:underline dark:text-indigo-400">
                                            {{ $file->original_name }}
                                        </a>
                                    </div>
                                    <button
                                        type="button"
                                        class="ml-4 text-red-500 text-sm hover:underline delete-file-btn"
                                        data-id="{{ $file->id }}"
                                        data-url="{{route('files.destroy', $file->id)}}"
                                    >
                                        Удалить
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="w-2/3 mx-auto mb-4">
                    <label for="files" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Прикрепить файлы</label>
                    <input
                        multiple
                        type="file"
                        id="files"
                        name="files[]"
                        class="block w-full px-3 py-2 text-gray-500 dark:bg-gray-800 border dark:text-white/60 border-gray-300 dark:border-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-indigo-500 @error('file') border-red-400 dark:border-red-400 @enderror"
                    />
                    @error('files')
                    <p class="text-center font-bold font-semibold mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 mb-1 text-sm text-gray-500 dark:text-gray-400">Вы можете прикрепить несколько файлов, но не более 5. <span class="mt-1 mb-2 text-sm text-red-400 dark:text-red-400">Максимальный размер файла 30 мегабайт.</span></p>
                    <p class="text-base font-sm text-gray-500 dark:text-white"><span class="font-bold text-red-500">*</span> - поле обезательное для заполнения</p>
                </div>

                <div class="w-1/3 mx-auto">
                    <button
                        type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Сохранить
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script>
            document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-file-btn');

            deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
            const fileId = this.dataset.id;
            const url = this.dataset.url;
            const listItem = this.closest('li');
            const fileListContainer = listItem.closest('.file-list-wrapper'); // добавим класс для обёртки

            if (confirm('Удалить этот файл?')) {
            fetch(url, {
            method: 'DELETE',
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        })
            .then(response => {
            if (response.ok) {
            listItem.remove();

            // Проверим, остались ли другие <li>
            const remainingFiles = fileListContainer.querySelectorAll('li');
            if (remainingFiles.length === 0) {
            fileListContainer.remove(); // скрываем весь блок
        }
        } else {
            alert('Ошибка при удалении файла.');
        }
        })
            .catch(error => {
            console.error(error);
            alert('Произошла ошибка при удалении.');
        });
        }
        });
        });
        });
    </script>


@endsection
