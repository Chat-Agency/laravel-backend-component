<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface PathComponent
{
    public function useLocal(bool $local = true): static;

    public function getNamespace(): ?string;

    public function getPath(): string;

    public function getComponentPath(): string;

    public function setNamespace(string $namespace): static;

    public function setPath(string $path): static;
}
