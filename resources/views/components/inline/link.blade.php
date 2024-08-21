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

        $content = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];

        $content = $attrs['content'] ?? $content;
        $localAttrs['class'] .= $themes;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }
    }

@endphp

<a {{ $attributes->merge($localAttrs) }}>
   
    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach
    
    {{ $content }} {{ $slot }}

</a>