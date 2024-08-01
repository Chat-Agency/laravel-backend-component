@php

    $value = '';
    
    if ($padding == 'button') {
        $value = ' py-2 px-4 ';
    } elseif ($padding == 'button-compact') {
        $value = ' py-1 px-2 ';
    } elseif ($padding == 'button-medium') {
        $value = ' py-1 px-3 ';
    } elseif ($padding == 'button-big') {
        $value = ' py-4 px-5 ';
    }  elseif($padding == 'link') {
        $value = ' px-1 ';

    
    }  elseif($padding == 'top-sm') {
        $value = ' pt-4 ';
    }  elseif($padding == 'bottom-sm') {
        $value = ' pb-4 ';
    }  elseif($padding == 'left-sm') {
        $value = ' pl-4 ';
    }  elseif($padding == 'right-sm') {
        $value = ' pr-4 ';
    } 


@endphp {{ $value }}