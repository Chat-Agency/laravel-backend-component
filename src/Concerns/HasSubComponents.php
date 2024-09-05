<?php

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\BackendComponent;

trait HasSubComponents
{
    /** @var BackendComponent[] */
    protected array $subComponents = [];

    public function getSubComponents(): array
    {
        return $this->subComponents;
    }

    public function setSubComponent(BackendComponent $subComponent, ?string $name = null): static
    {
        if ($name) {
            $this->subComponents[$name] = $subComponent;

            return $this;
        }

        $this->subComponents[] = $subComponent;

        return $this;
    }

    public function setSubComponents(array $subComponents): static
    {
        foreach ($subComponents as $name => $subComponent) {
            $this->setSubComponent($subComponent, $name);
        }

        return $this;
    }
}
