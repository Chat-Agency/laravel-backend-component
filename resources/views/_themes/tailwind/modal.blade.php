@php

    $allSizes = "overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto ";

    $styles = [
        'default' => 'bg-white dark:bg-slate-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto',
        'overlay' => 'absolute inset-0 bg-gray-500 dark:bg-gray-700 opacity-75',

        /*
         * Sizes
         */
        'sm' => $allSizes.'sm:max-w-sm',
        'md' => $allSizes.'sm:max-w-md',
        'lg' => $allSizes.'sm:max-w-lg',
        'xl' => $allSizes.'sm:max-w-xl',
        '2xl' => $allSizes.'sm:max-w-2xl',
        '3xl' => $allSizes.'sm:max-w-3xl',
        '4xl' => $allSizes.'sm:max-w-4xl',
        'full' => $allSizes.'flex flex-col w-full top-5 bottom-5',
    ];
    
    $value = resolveTheme($styles, $modal);

@endphp {{ $value }}