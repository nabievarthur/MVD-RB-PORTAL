@extends('layouts.base-layout')


@section('content')
    <div class="container mx-auto px-6 mt-20 bg-white pb-4 rounded-md min-h-screen">
        <div class="border-b border-b-gray-200 flex justify-between items-center py-4 mb-4">
            <div>
                <h1 class="text-xl font-semibold">Новости</h1>
            </div>
            <div>
                <a href="{{route('login')}}"><button type="button" class="text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Добавить новость</button></a>
            </div>
        </div>
      <div class="flex flex-col space-y-4">
        <!-- Post 1 -->
        <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">

          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Post Title 1</h2>
            <p class="text-gray-600">This is a short description of the post. It provides a brief overview of the content.</p>
          </div>
        </div>

        <!-- Post 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Post Title 2</h2>
            <p class="text-gray-600">This is a short description of the post. It provides a brief overview of the content.</p>
          </div>
        </div>

        <!-- Post 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Post Title 3</h2>
            <p class="text-gray-600">This is a short description of the post. It provides a brief overview of the content.</p>
          </div>
        </div>

        <!-- Add more posts as needed -->
      </div>
    </div>
@endsection
