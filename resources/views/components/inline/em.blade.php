@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $content = null;
    $subComponents = [];

     if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $content = $attrs['content'] ?? $content;
        $themes = $attrs['themes'] ?? null;
        //$subComponents = $attrs['sub_components'] ?? $subComponents;
        //$extra = $attrs['extra'] ?? [];
        
        $localAttrs['class'] .= $themes;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }
    }


@endphp

<em 
    {{ $attributes->merge($localAttrs) }} >

        {{ $content }} {{ $slot }}

</em>
