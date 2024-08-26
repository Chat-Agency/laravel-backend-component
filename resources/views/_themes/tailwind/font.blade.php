@php

    $styles = [
        'extrabold' => 'font-extrabold',
        'bold' => 'font-bold',
        'semibold' => 'font-semibold',
        'medium' => 'font-medium',
        'thin' => 'font-thin',
        'italic' => 'italic',
        'not-italic' => 'not-italic',
    ];
    
    $value = resolveTheme($styles, $font);

@endphp {{ $value }}