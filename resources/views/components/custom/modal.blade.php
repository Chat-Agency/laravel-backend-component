@props([
    'attrs' => null,
    'container' => [],
])

<?php
    /** @var \ChatAgency\BackendComponents\Components\DefaultAttributeBag $attrs */
?>

@php

    /** 
     * Based on Jetstream
     * Dialog component
     * https://github.com/laravel/jetstream/blob/5.x/stubs/livewire/resources/views/components/modal.blade.php
     */
    use ChatAgency\BackendComponents\Builders\ComponentBuilder;
    use ChatAgency\BackendComponents\Enums\ComponentEnum;

    use function ChatAgency\BackendComponents\getThemes;
    
    $serverAttrs = [
        'x-show' => 'showModal',
    ];
    $content = null;
    $slot = $slot ?? null;
    

    $title = $title ?? null;
    $body = $body ?? null;
    $footer = $footer ?? null;
    $button = $button ?? null;

    $containerTheme = $container['theme'] ?? [];

    $overlay = $overlay ?? ComponentBuilder::make(ComponentEnum::DIV)
        ->setTheme('modal', 'overlay');

    if($attrs) {

        $serverAttrs = array_merge($serverAttrs, $attrs->getAttributes());

        $content = $attrs->content;
        
        $extra = $attrs->extra;
        $slots = $attrs->slots;

        $title = $slots['title'] ?? $title;
        $body = $slots['body'] ?? $body;
        $footer = $slots['footer'] ?? $footer;
        $button = $slots['button'] ?? $button;
        $overlay = $slots['overlay'] ?? $overlay;

        $container = $extra['container'] ?? $container;
        $containerTheme = $container['theme'] ?? $containerTheme;

    }
    
    
@endphp
<div x-data="{ 'showModal': false }">
    
   <!-- Modal Trigger --> {{ $button }}
    
    <div
        x-show="showModal"
        x-cloak
        @keydown.escape="showModal = false"
        class="{{ getThemes($containerTheme) }} fixed inset-0 overflow-y-auto px-4 py-6 z-50">
        
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

        <div 
            x-trap.inert.noscroll="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <div {{ $attributes->merge($serverAttrs) }}>
                
                {{ $title }}

                {{ $slot }}{{ $content }}{{ $body }}

                {{ $footer }}

            </div>
        </div>

    </div>

</div>
