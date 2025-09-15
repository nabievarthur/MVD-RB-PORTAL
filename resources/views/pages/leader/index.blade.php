@extends('layouts.base-layout')

@section('title', '- руководство')

@section('content')
    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">
        <div class="border-b border-b-gray-200 dark:border-b-gray-600 flex justify-between items-center py-4 mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold text-black/80 dark:text-white mr-4">Руководство МВД по Республике
                    Башкортостан</h1>
            </div>
            <div class="flex justify-between items-center">
                <x-button-back route="home"/>
            </div>
        </div>
        <div>
            <!-- Карточка министра -->
            @php
                $chief = $leaders->firstWhere('priority', 'Министр внутренних дел');
                $deputies = $leaders->where('priority', '!=', 'Министр внутренних дел');
            @endphp

            @if($chief)
                <div class="mt-10 flex justify-center">
                    <div class="grid grid-cols-1 gap-6 justify-center">
                        <x-chief-card
                            image="{{$chief->files->first()?->path}}"
                            name="{{$chief->full_name}}"
                            rank="{{$chief->rank}}"
                            position="{{$chief->position}}"
                            position-class="text-sm text-orange-500 dark:text-orange-300"
                        ></x-chief-card>
                    </div>
                </div>
            @endif

            <!-- Карточки замов -->
            <div class="mt-10 flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 justify-center">
                    @foreach($deputies as $leader)
                        <x-chief-card
                            image="{{$leader->files->first()?->path}}"
                            name="{{$leader->full_name}}"
                            rank="{{$leader->rank}}"
                            position="{{$leader->position}}"
                        ></x-chief-card>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
