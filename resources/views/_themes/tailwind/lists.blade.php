@php

    $styles = [
        'ordered' => 'list-decimal',
        'unordered' => 'list-disc',
        'inside' => 'list-inside',
    ];
    
    $value = resolveTheme($styles, $lists);

@endphp {{ $value }}


