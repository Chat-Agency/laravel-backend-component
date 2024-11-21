<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Contracts\AttributeBag;

trait IsBackendComponent
{
    private array $attributes = [];

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $name): ?string
    {
        return $this->getAttributes()[$name] ?? null;
    }

    public function getAttributeBag(): AttributeBag
    {
        $attrs = $this->toArray();

        return new DefaultAttributeBag(...$attrs);
    }

    public function setAttribute(string $name, $content): static
    {
        $this->attributes[$name] = $content;

        return $this;
    }

    public function setAttributes(array $attributes): static
    {
        foreach ($attributes as $name => $content) {
            $this->setAttribute($name, $content);
        }

        return $this;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
