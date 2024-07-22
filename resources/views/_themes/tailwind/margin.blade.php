@php

    $styles = [
        'top-sm' => 'mt-3',
        'buttom-sm' => 'mb-3',
    ];
    
    $value = resolveTheme($styles, $margin);

@endphp {{ $value }}
{{-- <span class=""></span> --}}