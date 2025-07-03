<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ContentComponent
{
    public function getContent(string|int $key): CompoundComponent|int|string|null;

    /**
     * @return array<string|int, string|int|CompoundComponent>
     */
    public function getContents(): array;

    public function setContent(string|CompoundComponent $content, string|int|null $key = null): static;

    /**
     * @param  array<string|int, string|int|CompoundComponent>  $contents
     */
    public function setContents(array $contents): static;

    public function processContent(): ContentsComponent;
}
