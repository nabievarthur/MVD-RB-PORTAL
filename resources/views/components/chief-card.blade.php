@props([
    'image',
    'name',
    'rank',
    'position',
    'positionClass' => 'text-sm text-gray-700 dark:text-gray-300'
])

<div
    class="w-72 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border-2 border-gray-200 dark:border-gray-700 hover:border-blue-700 transition-colors duration-300">
    <div class="h-52 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
        <img
            class="h-full w-full object-cover object-top"
            src="{{ asset('images/chiefs/' . $image) }}"
            alt="Фотография руководителя">
    </div>
    <div class="p-4 text-center">
        <h3 class="text-lg font-bold text-gray-700 dark:text-white mb-1">{{ $name }}</h3>
        <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">{{ $rank }}</p>
        <p class="{{$positionClass}}">{{ $position }}</p>
    </div>
</div>
