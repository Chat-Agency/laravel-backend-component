@props([
    'attrs' => [],
])

<x-backend-component::form.text {{ $attributes->merge(['type' => 'email']) }} :attrs="$attrs" />