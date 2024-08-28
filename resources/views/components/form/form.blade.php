@props([
    'attrs' => [],
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

        $content = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponent;
        $extra = $attrs['extra'] ?? [];
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $content = $attrs['content'] ?? $content;
        $localAttrs['class'] .= $themes;

        $method = $localAttrs['method'] ?? null;

        if($method) {
            $localAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : 'POST';

            $methodInput = makeBackendComponent(ComponentEnum::HIDDEN)
                ->setAttribute('name', '_method' )
                ->setAttribute('value', $method );
        }

        /**
         * Default button
         */
        $hasButton = $extra['has_button'] ?? null;

        if($hasButton ) {
            $buttonDefault = makeBackendComponent(ComponentEnum::BUTTON)
                ->setTheme('action', 'default')
                ->setTheme('padding', 'button')
                ->setContent(__('Send'));
        }

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }
    }

@endphp

<form {{ $attributes->merge($localAttrs) }}>   
    
    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach

    {{ $buttonDefault }}

    {{ $methodInput }}

    {{ $content }} {{ $slot }}

</form>