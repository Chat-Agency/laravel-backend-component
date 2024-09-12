<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\BackendComponent;

trait HasContent
{
    protected string|BackendComponent|null $content = null;

    public function getContent(): string|BackendComponent|null
    {
        return $this->content;
    }

    public function setContent(string|BackendComponent $content): static
    {
        $this->content = $content;

        return $this;
    }
}
