@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs) ? true : false;
    $localAttrs = [
        'type' => 'text',
    ];
    $value = null;

    if($hasAttrs) {

        $localAttrs = array_merge($localAttrs, $attrs['attributes'] ) ?? $localAttrs;

        $value = $attrs['value'] ?? null;
        $themes = $attrs['themes'] ?? [];
        //$subComponents = $attrs['sub_components'] ?? [];
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['value'] ?? $value;
        $localAttrs['class'] .= bladeThemes($themes);

    }

@endphp

<input {{ $attributes->merge($localAttrs) }} />