@props([
    'image',
    'name',
    'rank',
    'position',
    'positionClass' => 'text-sm text-gray-700 dark:text-gray-300'
])

<div
    class="w-60 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md border-2 border-gray-200 dark:border-gray-800 hover:border-blue-700 transition-colors duration-300">
    <div class="h-56 w-full bg-gray-200/50 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
        <img
            class="h-full w-full object-cover object-top"
            src="{{ asset('storage/' . $image) }}"
            alt="Фотография руководителя"
            loading="lazy"
            onerror="this.style.display='none'; this.parentNode.classList.add('items-center', 'justify-center'); this.parentNode.innerHTML='<svg class=&quot;w-16 h-16 text-gray-400&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; viewBox=&quot;0 0 24 24&quot;><path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z&quot;></path></svg>';">
    </div>
    <div class="p-4 text-center">
        <h3 class="text-sm font-bold text-gray-700 dark:text-white mb-1">{{ $name }}</h3>
        <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">{{ $rank }}</p>
        <p class="{{ $positionClass }}">{{ $position }}</p>
    </div>
</div>
