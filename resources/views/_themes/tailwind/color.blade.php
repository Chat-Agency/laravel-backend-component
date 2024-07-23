@php

    $styles = [
        'default' => 'text-black',
        'light' => 'text-white',
        'error' => 'text-red-600',
        'success' => 'text-green-600',
        'info' => 'text-cyan-500',
        'warning' => 'text-yellow-600',
        'default-dark' => 'dark:text-white',
        'error-dark' => 'dark:text-red-400',
        'success-dark' => 'dark:text-green-400',
        'info-dark' => 'dark:text-cyan-300',
        'warning-dark' => 'dark:text-yellow-300',
    ];
    
    $value = resolveTheme($styles, $color);

@endphp {{ $value }}