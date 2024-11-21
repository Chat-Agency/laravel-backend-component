<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\BackendComponent;

trait HasSlots
{
    private array $slots = [];

    public function getSlots(): array
    {
        return $this->slots;
    }

    public function getSlot(string $name): BackendComponent
    {
        return $this->getSlots()[$name] ?? null;
    }

    public function setSlot(string $name, BackendComponent $slot): static
    {
        $this->slots[$name] = $slot;

        return $this;
    }

    public function setSlots(array $slots): static
    {
        foreach ($slots as $name => $slot) {
            $this->setSlot($name, $slot);
        }

        return $this;
    }
}
