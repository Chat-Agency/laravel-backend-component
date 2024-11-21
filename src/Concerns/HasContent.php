<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Components\ContentsComponent;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use Illuminate\Contracts\Support\Htmlable;

trait HasContent
{
    private array $content = [];

    public function getContent($key = null): string|BackendComponent|null
    {
        return $this->content[$key] ?? null;
    }

    public function getContents(): array
    {
        return $this->content;
    }

    public function setContent(string|BackendComponent $content, $key = null): static
    {
        if ($key) {
            $this->content[$key] = $content;
        }

        $this->content[] = $content;

        return $this;
    }

    public function setContents(array $contents): static
    {
        foreach ($contents as $key => $content) {
            $this->setContent($content, $key);
        }

        return $this;
    }

    public function processContent(): Htmlable
    {
        return new ContentsComponent($this->getContents());
    }
}
