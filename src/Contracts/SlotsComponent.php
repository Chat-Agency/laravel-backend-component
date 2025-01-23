<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

interface SlotsComponent
{
    public function getSlots(): array;

    public function getSlot(string $name): Arrayable|BackendComponent|ContentComponent|ExtraParamsComponent|Htmlable|LivewireComponent|PathComponent|SlotsComponent|ThemeComponent;

    public function setSlot(string $name, BackendComponent $slot): static;

    public function setSlots(array $slots): static;
}
