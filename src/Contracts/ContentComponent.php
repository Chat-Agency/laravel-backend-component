<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ContentComponent
{
    public function getContent(): string|BackendComponent|null;

    public function setContent(string|BackendComponent $content): static;
}
