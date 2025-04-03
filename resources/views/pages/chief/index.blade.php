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
                <a href="{{route('home')}}">
                    <button type="button"
                            class="text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Назад
                    </button>
                </a>
            </div>
        </div>
        <div>
            <!-- Карточка министра -->
            <div class="mt-10 flex justify-center">
                <div class="grid grid-cols-1 gap-6 justify-center">
                    <x-chief-card
                        image="Pryadko.jpg"
                        name="Прядко Александр Александрович"
                        rank="Генерал-лейтенант полиции"
                        position="Министр внутренних дел по Республике Башкортостан"
                        position-class="text-sm text-orange-500 dark:text-orange-300"
                    ></x-chief-card>
                </div>
            </div>
            <div class="mt-10 flex justify-center">
                <!-- Карточки замов -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 justify-center">

                    <x-chief-card
                        image="Saifullin.jpg"
                        name="Сайфуллин Артур Фаридович"
                        rank="Генерал-майор полиции"
                        position="Заместитель министра - начальник полиции"
                    ></x-chief-card>

                    <x-chief-card
                        image="Zubairov.jpg"
                        name="Зубаиров Айдар Фарузович"
                        rank="Генерал-майор полиции"
                        position="Заместитель министра внутренних дел"
                    ></x-chief-card>

                    <x-chief-card
                        image="Poltavec.jpg"
                        name="Полтавец Евгений Алексеевич"
                        rank="Генерал-майор внутренней службы"
                        position="Заместитель министра внутренних дел"
                    ></x-chief-card>

                    <x-chief-card
                        image="Baranov.jpg"
                        name="Баранов Юрий Борисович"
                        rank="Полковник юстиции"
                        position="Заместитель министра внутренних дел - начальник ГСУ"
                    ></x-chief-card>
                </div>
            </div>
            <div class="mt-10 flex justify-center">
                <!-- Карточки зам-замов -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 justify-center">

                    <x-chief-card
                        image="Semenov.jpg"
                        name="Семенов Дмитрий Сергеевич"
                        rank="Полковник полиции"
                        position="Заместитель начальника полиции (по оперативной работе)"
                    ></x-chief-card>

                    <x-chief-card
                        image="Skornyakov.jpg"
                        name="Скорняков Руслан Александрович"
                        rank="Полковник полиции"
                        position="Заместитель начальника полиции (по охране общественного порядка)"
                    ></x-chief-card>

                    <x-chief-card
                        image="Shaimuhametov.jpg"
                        name="Шаймухаметов Радик Имаммухаметович"
                        rank="Полковник полиции"
                        position="Заместитель начальника полиции"
                    ></x-chief-card>

                    <x-chief-card
                        image="Faizullin.jpg"
                        name="Файзуллин Руслан Рашитович"
                        rank="Полковник юстиции"
                        position="Первый заместитель начальника ГСУ МВД по РБ"
                    ></x-chief-card>
                </div>
            </div>
            <div class="mt-10 flex justify-center">

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-center">

                    <x-chief-card
                        image="Bryzgalin.jpg"
                        name="Брызгалин Александр Анатольевич"
                        rank="Полковник полиции"
                        position="Начальник УРЛС МВД по РБ"
                    ></x-chief-card>

                    <x-chief-card
                        image="Dubrovkin.jpg"
                        name="Дубровкин Олег Михайлович"
                        rank="Полковник внутренней службы"
                        position="Начальник штаба МВД по РБ"
                    ></x-chief-card>

                    <x-chief-card
                        image="Avdeev.jpg"
                        name="Авдеев Андрей Николаевич"
                        rank="Полковник внутренней службы"
                        position="Начальник тыла МВД по РБ"
                    ></x-chief-card>

                </div>
            </div>
        </div>
    </div>
@endsection
