@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $content = null;
    //$subComponents = [];

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $themes = $attrs['themes'] ?? null;
        // $subComponents = $attrs['sub_components'] ?? $subComponents;
        // $extra = $attrs['extra'] ?? [];

        $content = $attrs['content'] ?? $content;
        $localAttrs['class'] .= $themes;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }
    }

@endphp

<textarea {{ $attributes->merge($localAttrs) }} >{{ $content }}{{ $slot }}</textarea>