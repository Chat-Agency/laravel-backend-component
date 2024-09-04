@props([
    'attrs' => null,
])

@php
    $serverAttrs = [];
    $content = null;
    $subComponents = [];

    if($attrs) {

        $serverAttrs = $attrs->getAttributes();

        $content = $attrs->content;
        $subComponents = $attrs->subComponents;
        
    }

@endphp

<template {{ $attributes->merge($serverAttrs) }}> 
    
    @foreach($subComponents as $subComponent)
        {{ $subComponent }}
    @endforeach

    {{ $content }}{{ $slot }}

</template>