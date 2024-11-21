<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;

final class ContentComponent implements Arrayable, Htmlable
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
