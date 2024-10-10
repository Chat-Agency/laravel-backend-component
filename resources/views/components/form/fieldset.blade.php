@props([
    'attrs' => null,
])

<?php
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [];
    $content = null;
    $child = [];

    if($attrs) {

        $serverAttrs = $attrs->getAttributes();

        $content = $attrs->content;
        $child = $attrs->children;
        
    }

@endphp

<fieldset {{ $attributes->merge($serverAttrs) }}> 
    
    @foreach($child as $child)
        {{ $child }}
    @endforeach

    {{ $content }}{{ $slot }}

</fieldset>