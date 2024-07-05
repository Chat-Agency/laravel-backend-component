@php
    $path = $component->getPath();
    $componentArray =  $component->toArray();
@endphp

@if($component->isLivewire())
    @if ($component->livewireKey())
        @livewire($path, $componentArray, key($component->getLivewireKey()))
    @else 
        @livewire($path, $componentArray)
    @endif 
@else
    <x-dynamic-component :component="$path" :attrs="$componentArray" />
@endif 
