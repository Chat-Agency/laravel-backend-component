@props([
    'attrs' => [],
])

@php
    
    use ChatAgency\LaravelBackendComponents\Enums\InputComponentEnum;
    use ChatAgency\LaravelBackendComponents\Enums\ComponentEnum;
    
    $hasAttrs = !empty($attrs) ? true : false;
    $localAttrs = [];
    $value = null;

    $methodInput = null;
    $subComponents = [];
    $buttonDefault = null;

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? [];

        $value = $attrs['value'] ?? null;
        $themes = $attrs['themes'] ?? [];
        $subComponents = $attrs['sub_components'] ?? [];
        $extra = $attrs['extra'] ?? [];

        $value = $attrs['value'] ?? $value;
        $localAttrs['class'] = bladeThemes($themes);

        $method = $localAttrs['method'] ?? null;

        if($method) {
            $localAttrs['method'] = strtoupper($method) == 'GET' ? 'GET' : 'POST';

            $methodInput = makeBackendComponent(InputComponentEnum::HIDDEN)
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
                ->setValue(__('Send'));
        }
    }

@endphp

<form
    
    {{ $attributes->merge($localAttrs) }} 
>   
    {{ $methodInput }}

    {{ $value }} {{ $slot }}

    @foreach($subComponents as $component)
        {{{ $component }}}
    @endforeach

    {{  $buttonDefault }}

</form>