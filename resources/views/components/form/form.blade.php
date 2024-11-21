@props([
    'attrs' => null,
    'disableCToken' => false,
    'hasButton' => false,
])

<?php
    use ChatAgency\BackendComponents\Builders\ComponentBuilder;
    use ChatAgency\BackendComponents\Enums\ComponentEnum;

    use function ChatAgency\BackendComponents\makeBackendComponent;
    
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [];
    $content = null;
    
    $method = 'POST';

    if($attrs) {    

        $serverAttrs = $attrs->getAttributes();
        
        $content = $attrs->content;
        
        $extra = $attrs->extra;
        $slots = $attrs->slots;

        $serverAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : $method;
        $method = $serverAttrs['method'] ?? null ? strtoupper($serverAttrs['method']) : $method;
        
        $disableCToken = $extra['disable_token'] ?? $disableCToken;
    }

    $methodInput = makeBackendComponent(ComponentEnum::HIDDEN_INPUT)
        ->setAttribute('name', '_method' )
        ->setAttribute('value', $method );


@endphp

<form {{ $attributes->merge($serverAttrs) }}>   
    
    {{ $methodInput }}

    @if(!$disableCToken) @csrf @endif
    
    {{ $content }}{{ $slot }}

</form>