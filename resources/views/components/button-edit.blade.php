@props([
    'route',
    'id'
])

<a href="{{route($route, $id)}}">
<button

    type="button"
    class="text-white bg-gradient-to-r from-emerald-500 to-cyan-800 hover:from-emerald-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">
    Редактировать
</button>
</a>
