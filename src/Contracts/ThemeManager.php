<?php

namespace ChatAgency\LaravelBackendComponents\Contracts;

interface ThemeManager {
    public static function make(): self;

    public function useLocal($local = true) : self;

    public function getThemePath(): string;

    public function bladeThemes(array $themes);

    public function bladeTheme(string $type, string|ThemeBag|null $theme = null);

    public function resolveTheme(array $styleGroup, string|ThemeBag $style): string;

    public function isBag(string|ThemeBag $value): bool;
}
