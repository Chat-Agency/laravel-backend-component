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

        $content = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $content = $attrs['content'] ?? $content;
        $localAttrs['class'] .= $themes;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }
    }

@endphp

<h5 {{ $attributes->merge($localAttrs) }}> 
    
    @foreach($subComponents as $subComponent)
        {{ $subComponent }}
    @endforeach

    {{ $content }} {{ $slot }}

</h5>