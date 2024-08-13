@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $value = null;
    $subComponents = [];

    // Additional values
    $loading = null;
    $confirm = null;

     if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;

        $value = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['content'] ?? $value;
        $localAttrs['class'] .= $themes;

        $confirm = $extra['confirm'] ?? null;
    }

@endphp

<button 
    {{ $attributes->merge($localAttrs) }} 
    @if($confirm) onClick="confirm('{{ $confirm }}') || event.preventDefault();" @endif>

        @foreach($subComponents as $component)
            {{{ $component }}}
        @endforeach
    
        {{ $value }} {{ $slot }}

</button>
