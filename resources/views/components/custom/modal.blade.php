@props([
    'attrs' => [],
    'size' => null,
])

@php
    
    /** 
     * Based on Jetstream
     * Dialog component
     * https://github.com/laravel/jetstream/blob/5.x/stubs/livewire/resources/views/components/modal.blade.php
     */
    
    $hasAttrs = !empty($attrs);
    $localAttrs = [];
    $value = null;
    $subComponents = [];

    $title = $title ?? null;
    $footer = $footer ?? null;
    $button = $button ?? null;

    $sizes = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        'full' => 'flex flex-col w-full top-5 bottom-5 ',
    ];

    $maxWidth = $sizes[$size ?? '2xl'];

    if($hasAttrs) {

        $localAttrs = $attrs['attributes'] ?? $localAttrs;

        $value = $attrs['value'] ?? null;
        $themes = $attrs['themes'] ?? [];
        $subComponents = $attrs['sub_components'] ?? $subComponents;
        $extra = $attrs['extra'] ?? [];
        $slots = $attrs['slots'] ?? [];

        $localAttrs['class'] = $localAttrs['class'] ?? null;

        $value = $attrs['value'] ?? $value;
        $localAttrs['class'] .= bladeThemes($themes);
        
        $button = $slots['button'] ?? $button;

        // <x-dynamic.button @click="showModal = true" type="button" class="py-2 px-3 bg-slate-500 text-white rounded hover:bg-slate-600 focus:ring-gray-300">{{ $buttonLabel ?? 'Open Modal' }}</x-dynamic.button>
    }
    
@endphp

<div x-data="{ 'showModal': false }">
   
    <!-- Trigger for Modal -->
    
    {{ $button }}
    
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
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-700 opacity-75"></div>
        </div>

        <div x-show="showModal" class="{{ $maxWidth }} {{ $size == 'full' ? null : 'mb-6' }} bg-white dark:bg-slate-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"
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
                
                {{ $slot }} {{ $value }} 

            </div>

           {{ $footer }}

        </div>

        
    </div>
</div>
