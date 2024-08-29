<?php

namespace ChatAgency\BackendComponents\Contracts;

interface LivewireComponent
{
    
    public function setLivewire(bool $livewire = true) : static;

    public function setLivewireKey(string $livewireKey) : static;

    public function setLivewireParams(array $livewireParams) : static;

    public function isLivewire() : bool;

    public function getLivewireKey() : string | null;

    public function getLivewireParams() : array;

}
