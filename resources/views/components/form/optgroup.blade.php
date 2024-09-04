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

<optgroup {{ $attributes->merge($serverAttrs) }}> 
    
    @foreach($subComponents as $subComponent)
        {{ $subComponent }}
    @endforeach

    {{ $content }}{{ $slot }}

</optgroup>