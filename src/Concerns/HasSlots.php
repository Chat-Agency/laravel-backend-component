<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use Illuminate\Contracts\Support\Htmlable;

trait HasSlots
{
    /**
     * @var array<string, CompoundComponent|Htmlable>
     */
    private array $slots = [];

    /**
     * @return array<string, CompoundComponent|Htmlable>
     */
    public function getSlots(): array
    {
        return $this->slots;
    }

    public function getSlot(string $name): CompoundComponent|Htmlable
    {
        return $this->getSlots()[$name] ?? null;
    }

    public function setSlot(string $name, BackendComponent $slot): static
    {
        $this->slots[$name] = $slot;

        return $this;
    }

    /**
     * @param  array<string, CompoundComponent|Htmlable>  $slots
     */
    public function setSlots(array $slots): static
    {
        foreach ($slots as $name => $slot) {
            $this->setSlot($name, $slot);
        }

        return $this;
    }
}
