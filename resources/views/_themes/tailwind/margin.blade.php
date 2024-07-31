@php

    $styles = [
        'top-sm' => 'mt-3',
        'bottom-sm' => 'mb-3',
    ];
    
    $value = resolveTheme($styles, $margin);

@endphp {{ $value }}
{{-- <span class=""></span> --}}