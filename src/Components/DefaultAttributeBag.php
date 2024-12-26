<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;

readonly class DefaultAttributeBag implements AttributeBag
{
    public function __construct(
        private array $attributes,
        public readonly ?ContentsComponent $content = null,
        public readonly ?string $themes = null,
        public readonly ?string $path = null,
        public readonly array $slots = [],
        public readonly array $extra = [],
        public readonly bool $isLivewire = false,
        public readonly ?string $livewireKey = null,
        public readonly array $livewireParams = [],
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

    private function mergeClasses(): string
    {
        $class = $this->attributes['class'] ?? null ? $this->attributes['class'].'' : null;

        return $class.$this->themes;
    }
}
