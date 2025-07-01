<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use Illuminate\Contracts\Support\Htmlable;
use ChatAgency\BackendComponents\Contracts\BackendComponent;

interface SlotsComponent
{
    /**
     * @return array<string, BackendComponent|Htmlable>
     */ 
    public function getSlots(): array;

    public function getSlot(string $name): CompoundComponent|Htmlable;

    public function setSlot(string $name, BackendComponent $slot): static;

    /**
     * @param  array<string, BackendComponent|Htmlable>  $slots
     */
    public function setSlots(array $slots): static;
}
