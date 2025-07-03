<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;
use function ChatAgency\BackendComponents\isComponent;

final class DefaultContentsComponent implements ContentsComponent, Htmlable
{
    /**
     * @param  array<string|int,string|int|Htmlable|CompoundComponent>  $contents
     */
    public function __construct(
        private array $contents
    ) {}

    public function toHtml()
    {
        return view(backendComponentNamespace().'_utilities.resolve-content')
            ->with('contents', $this->contents)
            ->render();

    }

    /**
     * @return array<string, string|int|array<string, string|int>>
     */
    public function toArray(): array
    {
        $contents = [];

        foreach ($this->contents as $key => $content) {
            $contents[$key] = isComponent($content) ? $content->toArray() : $content;
        }

        return $contents;
    }
}
