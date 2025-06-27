<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use Illuminate\Contracts\Support\Htmlable;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;

interface SlotsComponent
{
    public function getSlots(): array;

    public function getSlot(string $name): CompoundComponent|Htmlable;

    public function setSlot(string $name, BackendComponent $slot): static;

    public function setSlots(array $slots): static;
}
