<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use Illuminate\Contracts\Support\Htmlable;

interface ContentComponent
{
    public function getContent(string|int $key): string|int|CompoundComponent|Htmlable;

    /**
     * @return array<string|int, string|int|CompoundComponent|Htmlable>
     */
    public function getContents(): array;

    public function setContent(string|BackendComponent $content, string|int|null $key = null): static;

    /**
     * @param  array<string|int, string|int|CompoundComponent|Htmlable>  $contents
     */
    public function setContents(array $contents): static;

    public function processContent(): ContentsComponent;
}
