<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\ExtraParamsComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\PathComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

trait HasSlots
{
    private array $slots = [];

    public function getSlots(): array
    {
        return $this->slots;
    }

    public function getSlot(string $name): Arrayable|BackendComponent|ContentComponent|ExtraParamsComponent|Htmlable|LivewireComponent|PathComponent|SlotsComponent|ThemeComponent
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
