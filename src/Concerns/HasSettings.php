<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

trait HasSettings
{
    /**
     * @var bool[]
     */
    private array $settings = [];

    public function setSetting(string $name, bool $value): static
    {
        $this->settings[$name] = $value;

        return $this;
    }

    public function setSettings(array $settings): static
    {
        foreach ($settings as $name => $value) {
            $this->setSetting($name, $value);
        }

        return $this;
    }

    public function getSetting(string $name): bool
    {
        return $this->settings[$name];
    }

    /**
     * @return bool[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }
}
