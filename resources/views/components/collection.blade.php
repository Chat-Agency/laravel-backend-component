@props([
    'attrs' => null,
])

<?php
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $content = null;
    $slot = $slot ?? null;
    
    if($attrs) {
        $content = $attrs->content;

    }

@endphp
{{ $content }}