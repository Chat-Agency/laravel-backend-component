<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface SettingsComponent
{
    public function setSetting(string $name, bool|string $value): static;

    public function setSettings(array $settings): static;

    public function getSetting(string $name): bool|string;

    /**
     * @return bool,string[]
     */
    public function getSettings(): array;
}
