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

    public function processThemes(array $themes): ?string;

    public function processTheme(string $type, string|array|null $theme = null): ?string;

    public function resolveTheme(array $styleGroup, string $style): string;
}
