<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\BackendComponent;

readonly class DefaultAttributeBag implements AttributeBag
{
    public function __construct(
        public string $name,
        public string|BackendComponent|null $content,
        public string $path,
        public array $attributes,
        public array $children = [],
        public ?string $themes = null,
        public array $slots = [],
        public array $extra = [],
        public bool $isLivewire = false,
        public ?string $livewireKey = null,
        public array $livewireParams = [],
    ) {}

    public function getAttributes(): array
    {
        $attrs = $this->attributes;

        $mergedClasses = $this->mergeClasses();

        if ($mergedClasses) {
            $attrs['class'] = $mergedClasses;
        }

        return $attrs;
    }

    protected function mergeClasses(): string
    {
        $class = $this->attributes['class'] ?? null ? $this->attributes['class'].'' : null;

        return $class.$this->themes;
    }
}
