@props([
    'attrs' => [],
    'size' => '2xl',
])

@php

    /** 
     * Based on Jetstream
     * Dialog component
     * https://github.com/laravel/jetstream/blob/5.x/stubs/livewire/resources/views/components/modal.blade.php
     */

    use ChatAgency\BackendComponents\Builders\ComponentBuilder;
    use ChatAgency\BackendComponents\Enums\ComponentEnum;
    
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $value = null;
    $subComponents = [];

    $title = $title ?? null;
    $footer = $footer ?? null;
    $button = $button ?? null;
    $overlay = $overlay ?? ComponentBuilder::make(ComponentEnum::DIV)
        ->setTheme('modal', 'overlay');

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;
        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['content'] ?? null;
        $themes = $attrs['themes'] ?? null;
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $slots = $attrs['slots'] ?? [];

        $value = $attrs['content'] ?? $value;
        $localAttrs['class'] .= $themes;
        
        $title = $slots['title'] ?? $title;
        $footer = $slots['footer'] ?? $footer;
        $button = $slots['button'] ?? $button;
        $overlay = $slots['overlay'] ?? $overlay;

        $size = $extra['size'] ?? $size;

        if(!$localAttrs['class'] ) {
            unset($localAttrs['class']);
        }
    }
    
    
@endphp

<div x-data="{ 'showModal': false }">
    
    {{ $button }}<!-- Trigger for Modal -->
    
    <div
        x-show="showModal"
        x-cloak
        @keydown.escape="showModal = false"
        class="fixed {{ $size == 'full' ? 'flex' : null }} inset-0 overflow-y-auto px-4 py-6 z-50">
        
        <div x-show="showModal" 
            class="fixed inset-0 transform transition-all" 
            x-on:click="showModal = false" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            {{ $overlay }}
        </div>

        <div x-show="showModal" class="{{ bladeThemes(['modal' => $size]) }}"
            x-trap.inert.noscroll="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            {{ $title  }}

            <div {{ $attributes->merge($localAttrs) }}>
                
                @foreach($subComponents as $subComponent)
                    {{ $subComponent }}
                @endforeach
                
                {{ $slot }} {{ $value }} 

            </div>

           {{ $footer }}

        </div>

    </div>

</div>
