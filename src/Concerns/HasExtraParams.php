<?php

namespace ChatAgency\BackendComponents\Concerns;

trait HasExtraParams
{
    protected array $extras = [];

    public function getExtras(): array
    {
        return $this->extras;
    }

    public function getExtra(string $name): mixed
    {
        return $this->getExtras()[$name] ?? null;
    }

    public function setExtra(string $name, mixed $content): static
    {
        $this->extras[$name] = $content;

        return $this;
    }

    public function setExtras(array $extras): static
    {
        foreach ($extras as $name => $content) {
            $this->setExtra($name, $content);
        }

        return $this;
    }
}
