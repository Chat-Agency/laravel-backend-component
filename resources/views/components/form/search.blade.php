@props([
    'attrs' => [],
])

<x-laravel-backend-component::form.text {{ $attributes->merge(['type' => 'search']) }} :attrs="$attrs" />