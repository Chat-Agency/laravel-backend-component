<?php

namespace ChatAgency\BackendComponents\Contracts;

interface SlotsComponent
{
    public function getSlots(): array;

    public function getSlot(string $name): BackendComponent;

    public function setSlot(string $name, BackendComponent $slot): static;

    public function setSlots(array $slots): static;
}
