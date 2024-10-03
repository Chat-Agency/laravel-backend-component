<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ThemeManager
{
    public static function make(): self;

    public function useLocal($local = true): self;

    public function getRawPath(): string;

    public function getThemePath(): string;

    public function getThemes(array $themes);

    public function getTheme(string $type, string|array|ThemeBag|null $theme = null): string;

    public function resolveTheme(array $styleGroup, string|ThemeBag $style): string;

    public function isBag(string|ThemeBag $value): bool;
}
