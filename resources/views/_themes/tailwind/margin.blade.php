@php

    $styles = [
        'top-sm' => 'mt-3',
        'bottom-sm' => 'mb-3',
        'left-sm' => 'ml-3',
        'right-sm' => 'mr-3',
    ];
    
    $value = resolveTheme($styles, $margin);

@endphp {{ $value }}
{{-- <span class=""></span> --}}