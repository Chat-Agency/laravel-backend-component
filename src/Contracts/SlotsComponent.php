<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface SlotsComponent
{
    /**
     * @return array<string, CompoundComponent>
     */
    public function getSlots(): array;

    public function getSlot(string $name): ?CompoundComponent;

    public function setSlot(string $name, CompoundComponent $slot): static;

    /**
     * @param  array<string, CompoundComponent>  $slots
     */
    public function setSlots(array $slots): static;
}
