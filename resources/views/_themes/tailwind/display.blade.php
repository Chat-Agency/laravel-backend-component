@php

    $styles = [
        'inline' => 'inline',
        'block' => 'block',
        'inline-block' => 'inline-block',
    ];
    
    $value = resolveTheme($styles, $display);

@endphp {{ $value }}