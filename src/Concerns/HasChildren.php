<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\BackendComponent;

trait HasChildren
{
    /** @var BackendComponent[] */
    protected array $children = [];

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChild(BackendComponent $child, string|int|null $name = null): static
    {
        if ($name) {
            $this->children[$name] = $child;

            return $this;
        }

        $this->children[] = $child;

        return $this;
    }

    public function setChildren(array $children): static
    {
        foreach ($children as $name => $child) {
            $this->setChild($child, $name);
        }

        return $this;
    }
}
