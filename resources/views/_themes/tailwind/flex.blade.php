@php
    $value = 'flex ';

    $styles = [
        'gap-sm' => 'gap-1',
        'align-middle' => 'align-middle',
    ];
    
    $value .= resolveTheme($styles, $flex);

@endphp {{ $value }}
{{-- <span class=" gap-1"></span> --}}