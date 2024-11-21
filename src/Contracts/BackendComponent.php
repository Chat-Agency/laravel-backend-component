<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface BackendComponent
{
    public function getAttributes(): array;

    public function getAttribute(string $name): ?string;

    public function getAttributeBag(): AttributeBag;

    public function setAttribute(string $name, $content): static;

    public function setAttributes(array $attributes): static;

    public function toArray(): array;

    public function __toString(): string;
    

}
