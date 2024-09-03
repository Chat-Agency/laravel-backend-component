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

        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        // $extra = $attrs['extra'] ?? [];
        $content = $attrs['content'] ?? $content;

        $localAttrs['class'] = $localAttrs['class'] ?? null;
        $localAttrs['class'] .= $themes;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }

    }

@endphp

<table {{ $attributes->merge($localAttrs) }} > 
    
    @foreach($subComponents as $subComponent)
        {{ $subComponent }}
    @endforeach

    {{ $content }}{{ $slot }}

</table>