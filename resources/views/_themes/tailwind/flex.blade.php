@php
    $value = 'flex ';

    $styles = [
        'gap-sm' => 'gap-1',
        'items-center' => 'items-center',
    ];
    
    $value .= resolveTheme($styles, $flex);

@endphp {{ $value }}
{{-- <span class=" gap-1"></span> --}}