@props([
    'attrs' => [],
])

<x-backend-component::form.text {{ $attributes->merge(['type' => 'hidden']) }} :attrs="$attrs" />