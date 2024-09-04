@props([
    'attrs' => null,
])

<?php
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [
        'type' => 'text',
    ];

    $content = null;

    if($attrs) {

        $serverAttrs = array_merge($serverAttrs, $attrs->getAttributes());
        $content = $attrs->content;
        
    }

@endphp

<input {{ $attributes->merge($serverAttrs) }}/>