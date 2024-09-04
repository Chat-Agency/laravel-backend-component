@props([
    'attrs' => null,
])

<?php
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [];
    $content = null;
    $subComponents = [];

    if($attrs) {

        $serverAttrs = $attrs->getAttributes();

        $content = $attrs->content;
        $subComponents = $attrs->subComponents;
    }
    
@endphp

<button {{ $attributes->merge($serverAttrs) }}>

    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach

    {{ $content }}{{ $slot }}

</button>
