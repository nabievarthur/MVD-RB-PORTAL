@props([
    'title' => '',
    'value' => '',
    'description' => '',
    'icon' => null,
    'iconPosition' => 'bottom-right',
    'iconSize' => '15',
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
            class="text-{{ $iconColor }} absolute opacity-{{ $iconOpacity }}
        @if($iconPosition === 'bottom-right') -right-4 -bottom-4 @endif
        @if($iconPosition === 'bottom-left') -left-4 -bottom-4 @endif
        @if($iconPosition === 'top-right') -right-4 -top-4 @endif
        @if($iconPosition === 'top-left') -left-4 -top-4 @endif"
            style="width: {{ $iconSize }}px; height: {{ $iconSize }}px;"
            viewBox="0 0 20 20"
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
