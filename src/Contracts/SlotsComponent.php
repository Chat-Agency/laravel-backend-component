<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface SlotsComponent
{
    /**
     * @return array<string, CompoundComponent|BackendComponent>
     */
    public function getSlots(): array;

    public function getSlot(string $name): CompoundComponent|BackendComponent|null;

    public function setSlot(string $name, CompoundComponent $slot): static;

    /**
     * @param  array<string, CompoundComponent|BackendComponent>  $slots
     */
    public function setSlots(array $slots): static;
}
