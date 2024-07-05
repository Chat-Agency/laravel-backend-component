@php

    $allButtons = 'rounded ';
    $allDarkButtons = 'text-white ';
    $allActions = 'disabled:opacity-30 transition duration-150 ease-in-out ';

    $styles = [
        
        // buttons

        'default' => $allButtons.$allDarkButtons.$allActions.'bg-blue-700 d-i hover:bg-blue-800 focus:ring-blue-300',
        'error' => $allButtons.$allDarkButtons.$allActions.'bg-red-700 hover:bg-red-800 focus:ring-red-300',
        'success' => $allButtons.$allDarkButtons.$allActions.'bg-green-700 hover:bg-green-800 focus:ring-green-300',
        'secondary' => $allButtons.$allDarkButtons.$allActions.'bg-gray-700 hover:bg-gray-800 focus:ring-gray-300',
        'info' => $allButtons.$allDarkButtons.$allActions.'bg-cyan-600 hover:bg-cyan-700 focus:ring-cyan-300',
        'warning' => $allButtons.$allDarkButtons.$allActions.'bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-500',
        'secondary-light' => $allButtons.$allDarkButtons.$allActions.'bg-gray-500 hover:bg-gray-600 focus:ring-gray-300',

        // lighter

        'success-lighter' => $allButtons.$allActions.'bg-green-200 hover:bg-green-300 focus:ring-green-300',
        'warning-lighter' => $allButtons.$allActions.'bg-yellow-200 hover:bg-yellow-300 focus:ring-yellow-400',
        'secondary-lighter' => $allButtons.$allActions.'bg-gray-200 hover:bg-gray-300 focus:ring-gray-300',

        // links

        'link' => $allActions.'text-blue-500 underline hover:no-underline',
        'link-error' => $allActions.'text-red-500 underline hover:no-underline',
        'link-success' => $allActions.'text-green-500 underline hover:no-underline',
        'link-warning' => $allActions.'text-yellow-700 underline hover:no-underline',
        'link-secondary' => $allActions.'text-gray-500 underline hover:no-underline',
    ];
    
    $value = resolveTheme($styles, $action);

@endphp {{ $value }}
{{-- <span class=""></span> --}}