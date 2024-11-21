@props([
    'attrs' => null,
])

@php
    $serverAttrs = [];
    $content = null;
    
    if($attrs) {

        $serverAttrs = $attrs->getAttributes();
        $content = $attrs->content;
        
    }

@endphp

<template {{ $attributes->merge($serverAttrs) }}>{{ $content }}{{ $slot }}</template>