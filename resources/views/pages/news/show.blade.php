@extends('layouts.base-layout')

@section('title', $news['title'])

@section('content')

    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">
        <div class="border-b border-b-gray-200 dark:border-b-gray-600 flex justify-between items-center py-4 mb-4">
            <h1 class="text-2xl font-bold text-black/80 dark:text-white">{{ $news['title'] }}</h1>
            <x-button-back/>
        </div>

        {{--<p class="text-gray-600 dark:text-blue-300 leading-relaxed">{!! \Illuminate\Support\Str::markdown($news['description']) !!}</p>--}}
        <p class="text-gray-600 dark:text-blue-300 leading-relaxed">{!! nl2br(e($news['description'])) !!}</p>

        <div class="flex justify-between items-center">
            <p class="mt-4 text-sm text-gray-600/70 dark:text-gray-400">Опубликовал: <span class="text-blue-700/70">{{$news['user']['subdivision']['title']}}</span></p>
            <p class="text-sm text-blue-700/70 dark:text-blue-100/40">{{ Carbon\Carbon::parse($news['created_at'])->format('d.m.Y H:i')}}</p>
        </div>

        @if(count($news['files']) > 0)
            <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-700 rounded-lg">
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


@endsection
