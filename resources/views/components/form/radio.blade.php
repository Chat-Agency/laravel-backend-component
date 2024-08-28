@props([
    'attrs' => [],
])

<x-backend-component::form.text {{ $attributes->merge(['type' => 'radio']) }} :attrs="$attrs" />