@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs) ? true : false;
    $localAttrs = [];
    $value = null;
    $subComponents = [];

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;

        $value = $attrs['value'] ?? null;
        $themes = $attrs['themes'] ?? [];
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['value'] ?? $value;
        $localAttrs['class'] .= bladeThemes($themes);
    }

@endphp

<label {{ $attributes->merge($localAttrs) }} > 
    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach
    
    {{ $value }} {{ $slot }}
</label>