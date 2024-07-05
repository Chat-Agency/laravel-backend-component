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
    }  elseif($padding == 'checkbox') {
        $value = ' ml-2 ';
    }  elseif($padding == 'checkbox-reverse') {
        $value = ' ml-1 mr-1 ';
    }  elseif($padding == 'md') {
        $value = ' p-4 ';
    }  elseif($padding == 'top-md') {
        $value = ' pt-8 ';
    } 

@endphp {{ $value }}
{{-- <span class=" p-5"></span> --}}