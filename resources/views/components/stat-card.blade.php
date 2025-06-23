@props([
    'title' => '',
    'value' => '',
    'description' => '',
    'icon' => null,
    'iconPosition' => 'bottom-right',
    'iconSize' => '24',
    'iconOpacity' => '20',
    'iconColor' => 'gray-600',
    'route' => '',
])

<a href="{{ route( $route) }}">
<div {{ $attributes->merge(['class' => 'bg-gray-700 p-6 rounded-lg shadow-lg relative overflow-hidden']) }}>
    @if($icon)
        <!-- Иконка на заднем фоне -->
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            @class([
                "h-$iconSize w-$iconSize text-$iconColor absolute opacity-$iconOpacity",
                '-right-4 -bottom-4' => $iconPosition === 'bottom-right',
                '-left-4 -bottom-4' => $iconPosition === 'bottom-left',
                '-right-4 -top-4' => $iconPosition === 'top-right',
                '-left-4 -top-4' => $iconPosition === 'top-left',
            ])
            viewBox="0 0 16 16"
        >
            {!! $icon !!}
        </svg>
    @endif

    <div class="relative z-10">
        @if($title)<h3 class="text-xl font-semibold text-gray-300">{{ $title }}</h3>@endif
        @if($value)<p class="text-4xl font-bold text-white mt-2">{{ $value }}</p>@endif
        @if($description)<p class="text-gray-400 mt-2">{{ $description }}</p>@endif

        {{ $slot }}
    </div>
</div>
</a>
