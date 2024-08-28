@php
    
    $styles = [
        'w-full' => 'w-full',
        'w-half' => 'w-1/4',
        
        'sm' => 'w-2 h-2',
        'md' => 'w-4 h-4',
        'lg' => 'w-8 h-8',
        'xl' => 'w-16 h-16',
    ];
    
    $value = resolveTheme($styles, $size);

@endphp {{ $value }}
