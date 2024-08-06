@php

    $styles = [
        'sm' => 'p-4',
        'top-sm' => 'pt-4',
        'bottom-sm' => 'pb-4',
        'left-sm' => 'pl-4',
        'right-sm' => 'pr-4',
        
        'button' => 'py-2 px-4',
        'button-compact' => 'py-1 px-2',
        'button-medium' => 'py-1 px-3',
        'button-big' => 'py-4 px-5',
        'link' => 'px-1',
    ];
    
    $value = resolveTheme($styles, $padding);
    
@endphp {{ $value }}