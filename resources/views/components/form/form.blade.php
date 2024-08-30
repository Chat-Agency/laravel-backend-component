@props([
    'attrs' => [],
    'disableCToken' => false,
    'hasButton' => false,
])

@php
    
    use ChatAgency\BackendComponents\Enums\ComponentEnum;
    use ChatAgency\BackendComponents\Enums\ComponentBuilder;
    
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $content = null;

    $methodInput = null;
    $subComponents = [];
    $buttonDefault = null;

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;

        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponent;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $content = $attrs['content'] ?? $content;
        $localAttrs['class'] .= $themes;

        $method = $localAttrs['method'] ?? null;

        $disableCToken = $extra['disable_token'] ?? $disableCToken;

        if($method) {
            $localAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : 'POST';

            $methodInput = makeBackendComponent(ComponentEnum::HIDDEN_INPUT)
                ->setAttribute('name', '_method' )
                ->setAttribute('value', $method );
        }

        /**
         * Default button
         */
        $hasButton = $extra['has_button'] ?? $hasButton;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }
    }

    if($hasButton) {
        $buttonDefault = makeBackendComponent(ComponentEnum::BUTTON)
            ->setTheme('action', 'default')
            ->setTheme('padding', 'button')
            ->setContent(__('Send'));
    }

@endphp

<form {{ $attributes->merge($localAttrs) }}>   
    
    {{ $methodInput }}

    @if(!$disableCToken) @csrf @endif
    
    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach

    {{ $buttonDefault }}

    {{ $content }} {{ $slot }}

</form>