<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\CompoundComponent;

trait HasSlots
{
    /**
     * @var array<string, CompoundComponent>
     */
    private array $slots = [];

    /**
     * @return array<string, CompoundComponent>
     */
    public function getSlots(): array
    {
        return $this->slots;
    }

    public function getSlot(string $name): ?CompoundComponent
    {
        return $this->getSlots()[$name] ?? null;
    }

    public function setSlot(string $name, CompoundComponent $slot): static
    {
        $this->slots[$name] = $slot;

        return $this;
    }

    /**
     * @param  array<string, CompoundComponent>  $slots
     */
    public function setSlots(array $slots): static
    {
        foreach ($slots as $name => $slot) {
            $this->setSlot($name, $slot);
        }

        return $this;
    }
}
