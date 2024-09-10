@php

    use function ChatAgency\BackendComponents\resolveTheme;
    
    $styles = [
        'button' => 'loading-spinner hidden animate-spin h-5 w-5 text-brand-primary',
    ];
    
    $value = resolveTheme($styles, $loading);

@endphp {{ $value }}
{{-- <span class=" gap-1"></span> --}}


