@props([
    'attrs' => [],
])

@php
    $hasAttrs = !empty($attrs) ? true : false;
    $localAttrs = [];
    $value = null;
    $subComponents = [];

    // Additional values
    $loading = null;
    $confirm = null;

     if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;

        $value = $attrs['value'] ?? null;
        $themes = $attrs['themes'] ?? [];
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['value'] ?? $value;
        $localAttrs['class'] .= bladeThemes($themes);

        //dd($themes);
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
