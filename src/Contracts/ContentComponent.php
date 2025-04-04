<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ContentComponent
{
    public function getContent($key = null): string|BackendComponent|ContentComponent|ExtraParamsComponent|LivewireComponent|PathComponent|SlotsComponent|ThemeComponent|null;

    public function getContents(): array;

    public function setContent(string|BackendComponent $content, $key = null): static;

    public function setContents(array $contents): static;

    public function processContent(): ContentsComponent;
}
