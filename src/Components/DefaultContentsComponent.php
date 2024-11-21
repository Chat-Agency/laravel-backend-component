<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use ChatAgency\BackendComponents\Contracts\ContentsComponent;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;

final class DefaultContentsComponent implements Arrayable, ContentsComponent, Htmlable
{
    public function __construct(private array $contents) {}

    public function toHtml()
    {
        return view(backendComponentNamespace().'_utilities.resolve-content')
            ->with('contents', $this->contents)
            ->render();

    }

    public function toArray(): array
    {
        return $this->contents;
    }
}
