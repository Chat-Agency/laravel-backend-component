<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ThemeManager
{
    public function setDefaultPath(string $path): static;

    public function getDefaultPath(): string;

    public function getThemePath(): string;

    public function disableCache(bool $disable = true): static;

    public function unsetCacheHits(): static;

    public function getCacheHits(): int;

    /**
     * @param  array<string, string|array<string, string>>  $themes
     */
    public function processThemes(array $themes): ?string;

    /**
     * @param  string|null|array<string, string|array<int, string>>  $theme
     *
     * @throws \Exception
     */
    public function processTheme(string $type, string|array|null $theme = null): ?string;

    /**
     * @param  array<string, string>  $styleGroup
     * @param  array<string, string|array<int|string, string>>  $style
     */
    public function resolveTheme(array $styleGroup, string|array $style): string;
}
