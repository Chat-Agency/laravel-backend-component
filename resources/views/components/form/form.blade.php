@props([
    'attrs' => null,
    'disableCToken' => false,
    'hasButton' => false,
])

<?php
    use ChatAgency\BackendComponents\Enums\ComponentEnum;

    use function ChatAgency\BackendComponents\makeBackendComponent;
    
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [];
    $content = null;
    $slot = $slot ?? null;
    
    $method = 'POST';

    if($attrs) {    

        $serverAttrs = $attrs->getAttributes();
        
        $content = $attrs->content;
        
        $slots = $attrs->slots;

        $serverAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : $method;
        $method = $serverAttrs['method'] ?? null ? strtoupper($serverAttrs['method']) : $method;
        
    }

    $methodInput = makeBackendComponent(ComponentEnum::HIDDEN_INPUT)
        ->setAttribute('name', '_method' )
        ->setAttribute('value', $method );


@endphp

<form {{ $attributes->merge($serverAttrs) }}>   
    
    {{ $methodInput }}

    @csrf
    
    {{ $content }}{{ $slot }}

</form>