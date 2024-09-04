@props([
    'attrs' => null,
    'disableCToken' => false,
    'hasButton' => false,
])

<?php
    use ChatAgency\BackendComponents\Builders\ComponentBuilder;
    use ChatAgency\BackendComponents\Enums\ComponentEnum;
    
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php
    $serverAttrs = [];
    $content = null;
    $subComponents = [];
    $method = 'POST';
    $methodInput = makeBackendComponent(ComponentEnum::HIDDEN_INPUT)
        ->setAttribute('name', '_method' )
        ->setAttribute('value', $method );

    if($attrs) {    

        $serverAttrs = $attrs->getAttributes();
        
        $content = $attrs->content;
        $subComponents = $attrs->subComponents;
        $extra = $attrs->extra;
        $slots = $attrs->slots;

        $method = $serverAttrs['method'] ?? null ? strtoupper($serverAttrs['method']) : $method;
        
        if($method) {
            $serverAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : $method;

            $methodInput = makeBackendComponent(ComponentEnum::HIDDEN_INPUT)
                ->setAttribute('name', '_method' )
                ->setAttribute('value', $method );
        }

        $disableCToken = $extra['disable_token'] ?? $disableCToken;

    }


@endphp

<form {{ $attributes->merge($serverAttrs) }}>   
    
    {{ $methodInput }}

    @if(!$disableCToken) @csrf @endif
    
    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach

    {{ $content }}{{ $slot }}

</form>