@php
    
    $styles = [
        'sm' => 'shadow-sm ',
        'md' => 'shadow ',
        'lg' => 'shadow-lg ',
        'xl' => 'shadow-xl ',
        '2xl' => 'shadow-2xl ',
        'inner' => 'shadow-inner',
    ];
    
    $value = resolveTheme($styles, $boxShadow);

@endphp {{ $value }}
