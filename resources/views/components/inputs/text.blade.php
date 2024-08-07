@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    $localAttrs = [
        'type' => 'text',
    ];
    //$value = null;

    if($hasAttrs) {

        $localAttrs = array_merge($localAttrs, $attrs['attributes'] ) ?? $localAttrs;

        //$value = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? [];
        //$subComponents = $attrs['sub_components'] ?? [];
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        //$value = $attrs['content'] ?? $value;
        $localAttrs['class'] .= bladeThemes($themes);

    }

@endphp

<input {{ $attributes->merge($localAttrs) }} />