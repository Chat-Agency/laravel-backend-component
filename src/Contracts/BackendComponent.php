<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface BackendComponent
{
    /**
     * @return array<string, string|null>
     */
    public function getAttributes(): array;

    public function getAttribute(string $name): ?string;

    public function getAttributeBag(): AttributeBag;

    public function setAttribute(string $name, ?string $content): static;

    /**
     * @param  array<string, string|null>  $attributes
     */
    public function setAttributes(array $attributes): static;

    public function __toString(): string;

    /**
     * @return array<string, array<mixed>|bool|string|null>
     */
    public function toArray(): array;
}
