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
    $disableMethodInput = false;
    
    $method = 'POST';

    if($attrs) {    

        $serverAttrs = $attrs->getAttributes();
        
        $content = $attrs->content;
        
        $slots = $attrs->slots;
        $settings = $attrs->settings;

        $method =  $serverAttrs['method'] ?? $method;

        $serverAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : 'POST';

        $disableCsrf = $settings['disable_csrf'] ?? $disableCsrf;
        $disableMethodInput = $settings['disable_method_input'] ?? $disableMethodInput;
        
    }

    $methodInput = $disableMethodInput ? null : makeBackendComponent(ComponentEnum::HIDDEN_INPUT)
        ->setAttribute('name', '_method' )
        ->setAttribute('value', strtoupper($method) );

@endphp

<form {{ $attributes->merge($serverAttrs) }}>   
    
    {{ $methodInput }}
    @if(!$disableCsrf) @csrf @endif
    {{ $content }}{{ $slot }}

</form>