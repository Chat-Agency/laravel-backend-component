<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface PathComponent
{
    public function useLocal($local = true): static;

    public function getName(): string;

    public function getNamespace(): ?string;

    public function getPath(): string;

    public function getComponentPath(): string;

    public function setNamespace(string $namespace): static;

    public function setPath(string $path): static;

    public function toHtml();
}
