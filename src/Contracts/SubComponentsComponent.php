<?php

namespace ChatAgency\BackendComponents\Contracts;

interface SubComponentsComponent
{
    public function getSubComponents(): array;

    public function setSubComponent(BackendComponent $subComponent, ?string $name = null): static;

    public function setSubComponents(array $subComponents): static;
}
