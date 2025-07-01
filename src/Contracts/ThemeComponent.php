<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ThemeComponent
{
    public function setTheme(string $name, string $theme): static;

     /**
     * @param array<string, string|array<string|int, string>> $themes
     */
    public function setThemes(array $themes): static;

    /**
     * @return array<string, string|array<string|int, string>>
     */
    public function getThemes(): array;

    /**
     * @return string|array<string|int, string>|null
     */
    public function getTheme(string $name): string|array|null;

    public function getThemeManager(): ThemeManager;

    public function compileTheme(): ?string;
}
