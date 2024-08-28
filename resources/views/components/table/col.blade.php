@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    //$content = null;

    if($hasAttrs) {

        $localAttrs = array_merge($localAttrs, $attrs['attributes'] ) ?? $localAttrs;

        //$content = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        //$subComponents = $attrs['sub_components'] ?? [];
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        //$content = $attrs['content'] ?? $content;
        $localAttrs['class'] .= $themes;

    }

@endphp

<col {{ $attributes->merge($localAttrs) }} />