@props([
    'attrs' => null,
])

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

<template {{ $attributes->merge($serverAttrs) }}> 
    
    @foreach($child as $child)
        {{ $child }}
    @endforeach

    {{ $content }}{{ $slot }}

</template>