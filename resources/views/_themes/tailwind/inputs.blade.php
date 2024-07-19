@php

    $styles = [
        'text' => 'p-2 border block w-full rounded-lg bg-gray-50 border-gray-300 placeholder-gray-400 focus:ring-gray-400 focus:border-gray-400',
        'text-dark' => 'dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-gray-500 dark:focus:border-gray-500',
        'checkbox' => 'w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-gray-500',
        'radio' => 'w-4 h-4 text-gray-500 bg-gray-100 border-gray-300 focus:ring-gray-500',
    ];
    
    $value = resolveTheme($styles, $inputs);

@endphp {{ $value }}
{{-- <span class=""></span> --}}