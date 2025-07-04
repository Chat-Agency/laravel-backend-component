<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use function ChatAgency\BackendComponents\backendComponentNamespace;

trait HasPath
{
    /**
     * Package namespace
     */
    private ?string $namespace = null;

    private ?string $path = null;

    private bool $useLocal = false;

    public function useLocal(bool $local = true): static
    {
        $this->useLocal = $local;

        return $this;
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
}
