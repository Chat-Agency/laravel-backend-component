<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use Illuminate\Contracts\Support\Htmlable;

interface ContentComponent
{
    public function getContent($key): string|BackendComponent|null;

    public function getContents(): array;

    public function setContent(string|BackendComponent $content, $key = null): static;

    public function setContents(array $contents): static;

    public function processContent(): Htmlable;
}
