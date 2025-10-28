@extends('layouts.base-layout')

@section('title', '- сервисы')

@section('content')
    <div class="container sm:w-11/12 mx-auto px-4 mt-20 bg-white dark:bg-gray-900 pb-4 rounded-md min-h-screen">

        <div class="border-b border-b-gray-200 dark:border-b-gray-600 flex justify-between items-center py-4 mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold text-black/80 dark:text-white mr-4">Сервисы МВД по Республике Башкортостан</h1>
            </div>
            <div class="flex justify-between items-center">
                <x-button-back route="home"/>
            </div>
        </div>
        <!-- Сетка карточек -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-5">
            <a href="#"
               class="h-[180px] bg-gray-100/30 dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl flex flex-col items-center justify-center gap-3 border-2 border-gray-100/30 dark:border-gray-800 hover:border-blue-700 transition-colors duration-300">

                <!-- SVG иконка -->
                <svg class="fill-blue-700 h-20 w-20" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m296-80-56-56 276-277 140 140 207-207 57 57-264 263-140-140L296-80Zm-136-40q-33 0-56.5-23.5T80-200v-560q0-33 23.5-56.5T160-840h560q33 0 56.5 23.5T800-760v168H160v472Zm0-552h560v-88H160v88Zm0 0v-88 88Z"/></svg>

                <!-- Текст -->
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2 group-hover:text-blue-700 transition-colors duration-300">
                    Статистическая информация
                </h2>
            </a>

            <a href="#"
               class="h-[180px] bg-gray-100/30 dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl flex flex-col items-center justify-center gap-3 border-2 border-gray-100/30 dark:border-gray-800 hover:border-blue-700 transition-colors duration-300">

                <!-- SVG иконка -->
                <svg class="fill-blue-700 h-20 w-20" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M360-240ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q32 0 64.5 3.5T489-425q-13 17-22.5 35.5T451-351q-23-5-45.5-7t-45.5-2q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32h323q4 22 11 42t18 38H40Zm320-320q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113Zm-400 80q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm320 440q34 0 56.5-20t23.5-60q1-34-22.5-57T680-360q-34 0-57 23t-23 57q0 34 23 57t57 23Zm0 80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 23-5.5 43.5T818-198L920-96l-56 56-102-102q-18 11-38.5 16.5T680-120Z"/>
                </svg>

                <!-- Текст -->
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2 group-hover:text-blue-700 transition-colors duration-300">
                    Запросы ОСК
                </h2>
            </a>

            <a href="#"
               class="h-[180px] bg-gray-100/30 dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl flex flex-col items-center justify-center gap-3 border-2 border-gray-100/30 dark:border-gray-800 hover:border-blue-700 transition-colors duration-300">
                <!-- SVG иконка -->
                <svg class="fill-blue-700 h-20 w-20" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200v-560 179-19 400Zm80-240h221q2-22 10-42t20-38H280v80Zm0 160h157q17-20 39-32.5t46-20.5q-4-6-7-13t-5-14H280v80Zm0-320h400v-80H280v80Zm-80 480q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v258q-14-26-34-46t-46-33v-179H200v560h202q-1 6-1.5 12t-.5 12v56H200Zm480-200q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM480-120v-56q0-24 12.5-44.5T528-250q36-15 74.5-22.5T680-280q39 0 77.5 7.5T832-250q23 9 35.5 29.5T880-176v56H480Z"/>
                </svg>

                <!-- Текст -->
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2 group-hover:text-blue-700 transition-colors duration-300">
                    АДМпрактика
                </h2>
            </a>

            <a href="#"
               class="h-[180px] bg-gray-100/30 dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl flex flex-col items-center justify-center gap-3 border-2 border-gray-100/30 dark:border-gray-800 hover:border-blue-700 transition-colors duration-300">
                <!-- SVG иконка -->
                <svg class="fill-blue-700 h-20 w-20" xmlns="http://www.w3.org/2000/svg" height="24px"
                     viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                    <path
                        d="M754-81q-8 0-15-2.5T726-92L522-296q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l85-85q6-6 13-8.5t15-2.5q8 0 15 2.5t13 8.5l204 204q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13l-85 85q-6 6-13 8.5T754-81Zm0-95 29-29-147-147-29 29 147 147ZM205-80q-8 0-15.5-3T176-92l-84-84q-6-6-9-13.5T80-205q0-8 3-15t9-13l212-212h85l34-34-165-165h-57L80-765l113-113 121 121v57l165 165 116-116-43-43 56-56H495l-28-28 142-142 28 28v113l56-56 142 142q17 17 26 38.5t9 45.5q0 24-9 46t-26 39l-85-85-56 56-42-42-207 207v84L233-92q-6 6-13 9t-15 3Zm0-96 170-170v-29h-29L176-205l29 29Zm0 0-29-29 15 14 14 15Zm549 0 29-29-29 29Z"/>
                </svg>

                <!-- Текст -->
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2 group-hover:text-blue-700 transition-colors duration-300">
                    Техническая поддержка
                </h2>
            </a>
        </div>
    </div>
@endsection
