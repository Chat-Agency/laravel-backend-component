@props([
    'attrs' => [],
])

<x-laravel-backend-component::form.text 
    {{ $attributes->merge(['type' => 'radio']) }}
    :attrs="$attrs" />