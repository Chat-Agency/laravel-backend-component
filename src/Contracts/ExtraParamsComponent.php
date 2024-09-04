<?php

namespace ChatAgency\BackendComponents\Contracts;

interface ExtraParamsComponent
{
    public function getExtras(): array;

    public function getExtra(string $name): mixed;

    public function setExtra(string $name, mixed $content): static;

    public function setExtras(array $extras): static;
}
