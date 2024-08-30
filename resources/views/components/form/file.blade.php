@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    
    if($hasAttrs) {
        $localAttributes = $attrs['attributes'] ?? [];
        if($localAttributes['value'] ?? null) {
            unset($localAttributes['value']);
            $attrs['attributes'] = $localAttributes;
        }
    }

@endphp

<x-backend-component::form.text {{ $attributes->merge(['type' => 'file']) }} :attrs="$attrs" />