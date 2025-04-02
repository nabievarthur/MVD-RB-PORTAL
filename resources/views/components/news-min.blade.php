@props([
    'title',
    'description',
    'date',
])

<div
    class="bg-gray-100/50 dark:bg-gray-800 border-2 border-transparent hover:border-blue-700 transition-colors duration-300 rounded-lg shadow-md overflow-hidden">

    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $title }}</h2>
        <p class="text-gray-600 dark:text-blue-300">{{ $description }}</p>

    </div>
    <div class="p-4 text-red-400">
        <p>{{ $date }}</p>
    </div>
</div>
