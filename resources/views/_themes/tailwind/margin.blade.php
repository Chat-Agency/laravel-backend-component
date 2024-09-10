@php

    use function ChatAgency\BackendComponents\resolveTheme;
    
    $styles = [
        'top-sm' => 'mt-3',
        'bottom-sm' => 'mb-3',
        'left-sm' => 'ml-3',
        'right-sm' => 'mr-3',
        
        'top-md' => 'mt-6',
        'bottom-md' => 'mb-6',
        'left-md' => 'ml-6',
        'right-md' => 'mr-6',

        'top-lg' => 'mt-12',
        'bottom-lg' => 'mb-12',
        'left-lg' => 'ml-12',
        'right-lg' => 'mr-12',
    ];
    
    $value = resolveTheme($styles, $margin);

@endphp {{ $value }}