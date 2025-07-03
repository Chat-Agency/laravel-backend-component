<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Components\DefaultContentsComponent;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;
use Illuminate\Contracts\Support\Htmlable;

trait HasContent
{
    /**
     * @var array<string|int, string|int|CompoundComponent|Htmlable>
     */
    private array $content = [];

    public function getContent(string|int $key): string|int|CompoundComponent|Htmlable
    {
        return $this->content[$key] ?? null;
    }

    /**
     * @return array<string|int, string|int|CompoundComponent|Htmlable>
     */
    public function getContents(): array
    {
        return $this->content;
    }

    public function setContent(string|BackendComponent $content, string|int|null $key = null): static
    {
        if ($key) {
            $this->content[$key] = $content;

            return $this;
        }

        $this->content[] = $content;

        return $this;
    }

    /**
     * @param  array<string|int, string|int|CompoundComponent|Htmlable>  $contents
     */
    public function setContents(array $contents): static
    {
        foreach ($contents as $key => $content) {
            $this->setContent($content, $key);
        }

        return $this;
    }

    public function processContent(): ContentsComponent
    {
        return new DefaultContentsComponent($this->getContents());
    }
}
