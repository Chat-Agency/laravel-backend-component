@props([
    'attrs' => [],
])

@php
    
    use ChatAgency\BackendComponents\Enums\InputEnum;
    use ChatAgency\BackendComponents\Enums\ComponentEnum;
    
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $value = null;

    $methodInput = null;
    $subComponents = [];
    $buttonDefault = null;

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;

        $value = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponent;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['content'] ?? $value;
        $localAttrs['class'] .= $themes;

        $method = $localAttrs['method'] ?? null;

        if($method) {
            $localAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : 'POST';

            $methodInput = makeBackendComponent(InputEnum::HIDDEN)
                ->setPath('inputs.')
                ->setAttribute('name', '_method' )
                ->setAttribute('value', $method );
        }

        /**
         * Button
         */
        $hasButton = $extra['has_button'] ?? null;

        if($hasButton ) {
            $buttonDefault = makeBackendComponent(ComponentEnum::BUTTON)
                ->setTheme('action', 'default')
                ->setTheme('padding', 'button')
                ->setContent(__('Send'));
        }
    }

@endphp

<form {{ $attributes->merge($localAttrs) }} 
>   
    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach

    {{ $buttonDefault }}

    {{ $methodInput }}

    {{ $value }} {{ $slot }}

</form>