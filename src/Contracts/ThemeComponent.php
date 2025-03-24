<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ThemeComponent
{
    public function setTheme(string $name, string|ThemeBag $theme): static;

    public function setThemes(array $themes): static;

    public function getThemes(): array;

    public function getTheme(string $name): string|array|ThemeBag|null;

    public function getThemeManager(): ThemeManager;

    public function compileTheme(): ?string;
}
