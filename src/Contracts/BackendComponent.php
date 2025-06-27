<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface BackendComponent
{
    public function getAttributes(): array;

    /** 
     * @return array<string, string|null>
     */
    public function getAttribute(string $name): ?string;

    public function getAttributeBag(): AttributeBag;

    public function setAttribute(string $name, ?string $content): static;

    public function setAttributes(array $attributes): static;

    public function __toString(): string;

    /**
     * @return array<string, string|int|array<string, string|int>>
     */
    public function toArray(): array;
}
