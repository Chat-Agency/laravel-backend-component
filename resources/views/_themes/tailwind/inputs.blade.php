@php
    
    use function ChatAgency\BackendComponents\resolveTheme;
    
    /**
     * Styles from:
     * https://preline.co/
     */
    $styles = [
        'text' => 'py-3 px-4 bg-white block border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none  placeholder-gray-400',
        'text-dark' => 'dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 dark:placeholder-gray-500 dark:focus:ring-gray-600',

        'checkbox' => 'bg-white border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none',
        'checkbox-dark' => 'dark:bg-gray-900 dark:border-gray-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800',
        
        'radio' => 'bg-white border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ',
        'radio-dark' => 'dark:bg-gray-900 dark:border-gray-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800',

        'file' => 'p-3 bg-white block border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none  placeholder-gray-400',
        'file-dark' => 'dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 dark:placeholder-gray-500 dark:focus:ring-gray-600',

        'textarea' => 'py-3 px-4 bg-white block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none',
        'textarea-dark' => ' dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 dark:placeholder-gray-500 dark:focus:ring-gray-600',
    ];

    $value = resolveTheme($styles, $inputs);

@endphp {{ $value }}