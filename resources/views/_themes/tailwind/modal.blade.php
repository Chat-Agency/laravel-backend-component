@php

    $styles = [
        'default' => 'bg-white dark:bg-slate-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto',
    ];
    
    $value = resolveTheme($styles, $modal);

@endphp {{ $value }}