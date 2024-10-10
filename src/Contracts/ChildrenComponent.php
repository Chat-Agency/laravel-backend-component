<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ChildrenComponent
{
    public function getChildren(): array;

    public function setChild(BackendComponent $child, ?string $name = null): static;

    public function setChildren(array $Children): static;
}
