@props([
    'attrs' => null,
])

<?php
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [];
    $content = null;
    

    if($attrs) {

        $serverAttrs = $attrs->getAttributes();
        $content = $attrs->content;
        
        
    }

@endphp

<h1 {{ $attributes->merge($serverAttrs) }}> 
    
    {{ $content }}{{ $slot }}

</h1>