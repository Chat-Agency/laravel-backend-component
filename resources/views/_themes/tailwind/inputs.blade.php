@php

    $styles = [
        'text' => 'p-2 border block w-full rounded-lg bg-gray-50 border-gray-300 placeholder-gray-400 focus:ring-blue-500  focus:border-gray-400',
        'text-dark' => 'dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:border-gray-500',
        /**
         * Styles from:
         * https://preline.co/docs/checkbox.html
         */
        'checkbox' => 'border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none',
        'checkbox-dark' => 'dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800',
        'radio' => 'w-4 h-4 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ',
        'radio-dark' => 'dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800',
    ];
    
    $value = resolveTheme($styles, $inputs);

@endphp {{ $value }}
{{-- <span class=""></span> --}}