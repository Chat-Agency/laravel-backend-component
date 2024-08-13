<?php

use ChatAgency\BackendComponents\Contracts\ThemeBag;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

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
    function makeBackendComponent( string | \BackedEnum $name): MainBackendComponent
    {
        return new MainBackendComponent($name);
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
    function bladeThemes(array $themes, ThemeManager $manager = new DefaultThemeManager)
    {
        return $manager->bladeThemes($themes['theming'] ?? []);
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
