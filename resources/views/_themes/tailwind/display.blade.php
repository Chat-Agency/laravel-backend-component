@php

    use function ChatAgency\BackendComponents\resolveTheme;
    
    $styles = [
        'flex' => 'flex',
        'inline' => 'inline',
        'block' => 'block',
        'inline-block' => 'inline-block',
        'table' => 'table',
    ];
    
    $value = resolveTheme($styles, $display);

@endphp {{ $value }}