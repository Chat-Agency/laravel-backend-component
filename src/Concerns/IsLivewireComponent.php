<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

trait IsLivewireComponent
{
    private bool $isLiveWire = false;

    private ?string $livewireKey = null;

    private array $livewireParams = [];

    public function setLivewire(bool $livewire = true): static
    {
        $this->isLiveWire = $livewire;

        return $this;
    }

    public function setLivewireParams(array $livewireParams): static
    {
        $this->livewireParams = $livewireParams;

        return $this;
    }

    public function setLivewireKey(string $livewireKey): static
    {
        $this->livewireKey = $livewireKey;

        return $this;
    }

    public function isLivewire(): bool
    {
        return $this->isLiveWire;
    }

    public function getLivewireParams(): array
    {
        return $this->livewireParams;
    }

    public function getLivewireKey(): ?string
    {
        return $this->livewireKey;
    }
}
