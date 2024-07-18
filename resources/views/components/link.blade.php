@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs) ? true : false;
    $localAttrs = [];
    $value = null;

     if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? [];

        $value = $attrs['value'] ?? null;
        $themes = $attrs['themes'] ?? [];
        $subComponents = $attrs['sub_components'] ?? [];
        $extra = $attrs['extra'] ?? [];

        $value = $attrs['value'] ?? $value;
        $localAttrs['class'] = bladeThemes($themes);
    }

@endphp

<a {{ $attributes->merge($localAttrs) }} >
   
     {{ $slot }} {{ $value }}

</a>
