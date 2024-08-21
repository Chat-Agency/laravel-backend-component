@props([
    'attrs' => [],
])

<x-laravel-backend-component::form.text 
    type="email"
    :attrs="$attrs" />