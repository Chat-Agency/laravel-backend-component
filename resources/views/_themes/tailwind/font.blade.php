@php

    $styles = [
        'bold' => 'font-bold',
    ];
    
    $value = resolveTheme($styles, $font);

@endphp {{ $value }}
{{-- <span class=" gap-1"></span> --}}