<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface LivewireComponent
{
    public function setLivewire(bool $livewire = true): static;

    public function setLivewireKey(string $livewireKey): static;

    public function setLivewireParams(array $livewireParams): static;

    public function isLivewire(): bool;

    public function getLivewireKey(): ?string;

    public function getLivewireParams(): array;
}
