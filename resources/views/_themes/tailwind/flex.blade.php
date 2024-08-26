@php
    $styles = [
        'flex' => 'flex',
        
        'gap-sm' => 'gap-1',
        'gap-md' => 'gap-3',
        'gap-lg' => 'gap-6',
        
        'col' => 'flex-col',
        'row' => 'flex-row',
        'col-reverse' => 'flex-col-reverse',
        'row-reverse' => 'flex-row-reverse',
       
        'items-center' => 'items-center',
        'items-start' => 'items-start',
        'items-end' => 'items-end',
        'items-baseline' => 'items-baseline',
        'items-stretch' => 'items-stretch',

        'justify-items-start' => 'justify-items-start',
        'justify-items-end' => 'justify-items-end',
        'justify-items-center' => 'justify-items-center',
        'justify-items-stretch' => 'justify-items-stretch',
    ];
    
    $value = resolveTheme($styles, $flex);

@endphp {{ $value }}