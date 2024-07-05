@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs) ? true : false;
    $localAttrs = [];
    $value = null;
    $loading = null;
    $confirm = null;

     if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? [];

        $value = $attrs['value'] ?? null;
        $themes = $attrs['themes'] ?? [];
        $subComponents = $attrs['sub_components'] ?? [];
        $extra = $attrs['extra'] ?? [];

        $value = $attrs['value'] ?? $value;
        $localAttrs['class'] = bladeThemes($themes);

        // Additional components
        $loading = $subComponents['loading'] ?? null;
        $confirm = $extra['confirm'] ?? null;
    }

@endphp

<button 
    {{ $attributes->merge($localAttrs) }} 
    @if($confirm) onClick="confirm('{{ $confirm }}') || event.preventDefault();" @endif>
   
    {{ $value }} {{ $slot }}
    
    {{ $loading }}

</button>
