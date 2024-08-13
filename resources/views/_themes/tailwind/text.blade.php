@php

    $styles = [
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        'xl' => 'text-xl',
        '2xl' => 'text-2xl',
        '3xl' => 'text-3xl',
        '4xl' => 'text-4xl',
        '5xl' => 'text-5xl',
        '6xl' => 'text-6xl',
    ];
    
    $value = resolveTheme($styles, $text);

@endphp {{ $value }}
{{-- <span class=" gap-1"></span> --}}