@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $value = null;
    $subComponents = [];

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;

        $value = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $value = $attrs['content'] ?? $value;

        $localAttrs['class'] = $localAttrs['class'] ?? null;
        $localAttrs['class'] .= $themes;

    }

@endphp

<table {{ $attributes->merge($localAttrs) }} > 
    
    @foreach($subComponents as $subComponent)
        {{ $subComponent }}
    @endforeach

    {{ $value }} {{ $slot }}

</table>