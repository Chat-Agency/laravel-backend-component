@props([
    'attrs' => [],
])

<x-laravel-backend-component::inputs.text 
    {{ $attributes->merge(['type' => 'checkbox']) }}
    :attrs="$attrs" />