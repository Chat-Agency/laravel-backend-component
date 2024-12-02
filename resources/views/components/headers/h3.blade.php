@props([
    'attrs' => null,
])

<?php
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [];
    $content = null;
    $slot = $slot ?? null;
    

    if($attrs) {

        $serverAttrs = $attrs->getAttributes();
        $content = $attrs->content;
        
        
    }

@endphp

<h3 {{ $attributes->merge($serverAttrs) }}> 
    
    {{ $content }}{{ $slot }}

</h3>