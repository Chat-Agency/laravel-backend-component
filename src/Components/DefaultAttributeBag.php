<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;

readonly class DefaultAttributeBag implements AttributeBag
{
    public function __construct(
        /** @var array<string, string> $attributes */
        private array $attributes,
        public readonly ?ContentsComponent $content = null,
        public readonly ?string $themes = null,
        public readonly ?string $path = null,
        /** @var array<string, BackendComponent> $slots */
        public readonly array $slots = [],
        /** @var array<string, bool|string> $settings */
        public readonly array $settings = [],
        public readonly bool $isLivewire = false,
        public readonly ?string $livewireKey = null,
        /** @var array<string, mixed> $livewireParams */
        public readonly array $livewireParams = [],
    ) {}

    /** @return array<string, string> */
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
