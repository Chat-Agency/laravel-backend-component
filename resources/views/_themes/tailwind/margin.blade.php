@php

    $styles = [
        'top-sm' => 'mt-3',
        'bottom-sm' => 'mb-3',
        'left-sm' => 'ml-3',
        'right-sm' => 'mr-3',
        
        'top-md' => 'mt-6',
        'bottom-md' => 'mb-6',
        'left-md' => 'ml-6',
        'right-md' => 'mr-6',
    ];
    
    $value = resolveTheme($styles, $margin);

@endphp {{ $value }}