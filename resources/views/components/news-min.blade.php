
<div class="bg-gray-100/30 dark:bg-gray-800 border-2 border-transparent hover:border-blue-700 transition-colors duration-300 rounded-lg shadow-md overflow-hidden flex">


    <a class="p-4 flex-1 grid grid-rows-[auto_1fr_auto] min-h-[150px] group" href="{{ route('news.show', $news['id']) }}">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2 group-hover:text-blue-700 transition-colors duration-300">
                {{ $news['title'] }}
            </h2>
            <p class="text-sm text-blue-700/70 dark:text-blue-100/40">
                {{ Carbon\Carbon::parse($news['created_at'])->format('d.m.Y H:i') }}
            </p>
        </div>

        <p class="text-gray-600 dark:text-blue-300">
            {{ mb_strlen($news['description']) > 355 ? mb_substr($news['description'], 0, 355) . "..." : $news['description'] }}
        </p>
        <p class="mt-3 text-sm text-gray-600/70 dark:text-gray-400">
            опубликовал: <span class="text-blue-700/70">{{ $news['user']['subdivision']['title'] }}</span>
        </p>
    </a>

    <!-- Блок с файлами (только если они есть) -->
    @if(count($news['files']) > 0)
        <div class="w-3/12 border-l border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-700/50">
            <h3 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Прикреплённые файлы:</h3>
            <ul class="space-y-2">
                @foreach($news['files'] as $file)
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <a href="{{ Storage::url($file['path']) }}"
                           target="_blank"
                           class="text-blue-600 dark:text-blue-400 hover:underline text-sm truncate"
                           title="{{ $file['original_name'] }}">
                            {{ $file['original_name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
