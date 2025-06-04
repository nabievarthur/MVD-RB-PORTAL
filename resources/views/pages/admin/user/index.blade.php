@extends('layouts.admin-layout')

@section('content')
    <div class="w-full overflow-x-auto mx-auto">

        <!-- Header with Search and Add User Button -->
        <div class="bg-gray-800 rounded-lg shadow-md m-4 p-4 flex justify-between items-center">
            <div>
                <input
                    type="text"
                    placeholder="Поиск пользователей..."
                    class="bg-gray-700 text-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 transition w-64"
                />
            </div>
            <div>
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                    <span>Добавить пользователя</span>
                </button>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-md m-4 pr-4 pl-4 pb-4">
            <table class="w-full bg-gray-700 text-gray-300">
                <thead>
                <tr class="border-b border-gray-600 bg-gray-800">
                    <th class="py-3 px-4 text-left font-semibold">ID</th>
                    <th class="py-3 px-4 text-left font-semibold">Логин</th>
                    <th class="py-3 px-4 text-left font-semibold">ФИО</th>
                    <th class="py-3 px-4 text-left font-semibold">Роль</th>
                    <th class="py-3 px-4 text-left font-semibold">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="border-b border-gray-600 hover:bg-gray-600 transition-colors">
                        <td class="py-3 px-4">{{$user->id}}</td>
                        <td class="py-3 px-4">{{$user->login}}</td>
                        <td class="py-3 px-4">{{$user->full_name}}</td>
                        <td class="py-3 px-4">{{$user->roles->pluck('name')->implode(', ') ?: 'пользователь'}}</td>
                        <td class="py-3 px-4 space-x-2 flex">
                            <button class="bg-indigo-500/50 text-white px-3 py-1 rounded hover:bg-indigo-800/50 transition flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                </svg>
                                <span>Редактировать</span>
                            </button>
                            <button class="bg-red-600/50 text-white px-3 py-1 rounded hover:bg-red-800/50 transition flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                <span>Удалить</span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 m-4">
            {{$users->withQueryString()->links()}}
        </div>
    </div>
@endsection
