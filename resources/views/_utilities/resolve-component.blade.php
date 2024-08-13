@php
    /** @var \ChatAgency\BackendComponents\Contracts\LaravelBackendComponent $component */
@endphp

@if($component->isLivewire())
    @php
        $name = $component->getName();
        $params = $component->getLivewireParams();
        $key = $component->getLivewireKey();
    @endphp
    
    @if ($key)
        @livewire($name, $params, key($key))
    @else 
        @livewire($name, $params)
    @endif 
@else
    @php
        $path = $component->getComponentPath();
        $componentArray =  $component->toArray();
    @endphp
    <x-dynamic-component :component="$path" :attrs="$componentArray" />
@endif 
