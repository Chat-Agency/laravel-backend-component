@props([
    'attrs' => [],
])

<x-laravel-backend-component::inputs.text 
    {{ $attributes->merge(['type' => 'hidden']) }}
    :attrs="$attrs" />