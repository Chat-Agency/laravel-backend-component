<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Components\DefaultContentsComponent;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;

trait HasSlots
{
    /**
     * @var array<string, CompoundComponent|BackendComponent>
     */
    private array $slots = [];

    /**
     * @return array<string, CompoundComponent|BackendComponent>
     */
    public function getSlots(): array
    {
        return $this->slots;
    }

    public function getSlot(string $name): CompoundComponent|BackendComponent|null
    {
        return $this->getSlots()[$name] ?? null;
    }

    public function setSlot(string $name, CompoundComponent|BackendComponent $slot): static
    {
        $this->slots[$name] = $slot;

        return $this;
    }

    /**
     * @param  array<string, CompoundComponent|BackendComponent>  $slots
     */
    public function setSlots(array $slots): static
    {
        foreach ($slots as $name => $slot) {
            $this->setSlot($name, $slot);
        }

        return $this;
    }

    public function processSlots(): ContentsComponent
    {
        return new DefaultContentsComponent($this->getContents());
    }
}
