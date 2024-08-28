@props([
    'attrs' => [],
])

<x-backend-component::form.text {{ $attributes->merge(['type' => 'checkbox']) }} :attrs="$attrs" />