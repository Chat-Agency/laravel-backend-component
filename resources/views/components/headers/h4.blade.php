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
        $themes = $attrs['themes'] ?? [];
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['content'] ?? $value;
        $localAttrs['class'] .= bladeThemes($themes);
    }

@endphp

<h4 {{ $attributes->merge($localAttrs) }} > 
    
    @foreach($subComponents as $subComponent)
        {{ $subComponent }}
    @endforeach

    {{ $value }} {{ $slot }}

</h4>