@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    $localAttrs = [
        'type' => 'text',
    ];
    //$content = null;

    if($hasAttrs) {

        $localAttrs = array_merge($localAttrs, $attrs['attributes'] ) ?? $localAttrs;

        $themes = $attrs['themes'] ?? null;
        //$subComponents = $attrs['sub_components'] ?? [];
        //$extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        //$content = $attrs['content'] ?? $content;
        $localAttrs['class'] .= $themes;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }

    }

@endphp

<input {{ $attributes->merge($localAttrs) }}/>