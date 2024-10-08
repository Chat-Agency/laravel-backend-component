<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use BackedEnum;
use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Contracts\AttributeBag;

use function ChatAgency\BackendComponents\backendComponentNamespace;

trait IsBackendComponent
{
    /**
     * Package namespace
     */
    protected ?string $namespace = null;

    protected ?string $path = null;

    protected bool $useLocal = false;

    protected array $attributes = [];

    public function useLocal($local = true): static
    {
        $this->useLocal = $local;

        return $this;
    }

    public function getName(): string
    {
        $name = $this->name;

        if ($name instanceof BackedEnum) {
            return $name->value;
        }

        return $name;
    }

    public function getNamespace(): ?string
    {
        return $this->useLocal
            ? null :
            ($this->namespace ?? backendComponentNamespace());
    }

    public function getPath(): string
    {
        return $this->getNamespace().$this->path;
    }

    public function getComponentPath(): string
    {
        return $this->getPath().$this->getName();
    }

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

    public function setNamespace(string $namespace): static
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
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

    public function toHtml()
    {
        return view(backendComponentNamespace().'_utilities.resolve-component')
            ->with('component', $this)
            ->render();

    }
}
