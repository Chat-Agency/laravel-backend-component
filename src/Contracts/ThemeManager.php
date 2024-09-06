<?php

namespace ChatAgency\BackendComponents\Contracts;

interface ThemeManager
{
    public static function make(): self;

    public function useLocal($local = true): self;

    public function getThemePath(): string;

    public function bladeThemes(array $themes);

    public function bladeTheme(string $type, string|array|ThemeBag|null $theme = null) : string;

    public function resolveTheme(array $styleGroup, string|ThemeBag $style) : string;

    public function isBag(string|ThemeBag $value): bool;
}
