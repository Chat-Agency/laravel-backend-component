@php

    use function ChatAgency\BackendComponents\resolveTheme;

    $styles = [
        'default' => 'text-black',
        'default-dark' => 'dark:text-white',
        'secondary' => 'text-slate-500',
        'secondary-dark' => 'dark:text-slate-400',
        'error' => 'text-red-600',
        'error-dark' => 'dark:text-red-400',
        'success' => 'text-green-600',
        'success-dark' => 'dark:text-green-400',
        'info' => 'text-cyan-500',
        'info-dark' => 'dark:text-cyan-300',
        'warning' => 'text-yellow-600',
        'warning-dark' => 'dark:text-yellow-300',
    ];
    
    $value = resolveTheme($styles, $color);

@endphp {{ $value }}