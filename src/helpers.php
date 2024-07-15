<?php

use ChatAgency\LaravelBackendComponents\BackendComponent;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeBag;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeManager;
use ChatAgency\LaravelBackendComponents\Themes\DefaultThemeManager;

/**
 * Utility classes
 */
if (! function_exists('BackendComponentNamespace')) {
    function BackendComponentNamespace(): string
    {
        return 'laravel-backend-component::';
    }
}

if (! function_exists('makeBackendComponent')) {
    function makeBackendComponent(string $name): BackendComponent
    {
        return new BackendComponent($name);
    }
}

if (! function_exists('isBackendComponent')) {
    function isBackendComponent($value)
    {
        return is_a($value, BackendComponent::class);
    }
}

/*
 * Bade theming
 */
if (! function_exists('bladeThemes')) {
    function bladeThemes(array $themes)
    {
        return resolveThemeManager($themes['config'] ?? [])
            ->bladeThemes($themes['theming'] ?? []);
    }
}

if (! function_exists('resolveTheme')) {
    function resolveTheme(array $styleGroup, string|ThemeBag $style): string
    {
        return DefaultThemeManager::make()
            ->resolveTheme($styleGroup, $style);
    }
}

if (! function_exists('resolveThemeManager')) {
    function resolveThemeManager(array $config) : ThemeManager
    {
        return $config['manager'] ?? DefaultThemeManager::make();
    }
}
