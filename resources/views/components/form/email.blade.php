@props([
    'attrs' => [],
])

<x-laravel-backend-component::form.text {{ $attributes->merge(['type' => 'email']) }} :attrs="$attrs" />