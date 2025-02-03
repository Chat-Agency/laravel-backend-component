@props([
    'attrs' => null,
    'disableCsrf' => false,
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
    $disableCsrf = false;
    
    $method = 'POST';

    if($attrs) {    

        $serverAttrs = $attrs->getAttributes();
        
        $content = $attrs->content;
        
        $slots = $attrs->slots;
        $settings = $attrs->settings;

        $serverAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : $method;
        $method = $serverAttrs['method'] ?? null ? strtoupper($serverAttrs['method']) : $method;
        $disableCsrf = $settings['disable_csrf'] ?? $disableCsrf;
        
    }

    $methodInput = makeBackendComponent(ComponentEnum::HIDDEN_INPUT)
        ->setAttribute('name', '_method' )
        ->setAttribute('value', $method );


@endphp

<form {{ $attributes->merge($serverAttrs) }}>   
    
    {{ $methodInput }}
    @if(!$disableCsrf) @csrf @endif
    
    {{ $content }}{{ $slot }}

</form>