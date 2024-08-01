@php

    $styles = [
        'ordered' => 'list-decimal',
        'unordered' => 'list-disc',
        'item' => 'mt-4',
        'inside' => 'list-inside',
    ];
    
    $value = resolveTheme($styles, $lists);

@endphp {{ $value }}


