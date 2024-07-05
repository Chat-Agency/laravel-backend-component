<?php

use ChatAgency\LaravelBackendComponents\BackendComponent;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeBag;
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
    function makeBackendComponent(string $type): BackendComponent
    {
        return new BackendComponent($type);
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
        return DefaultThemeManager::make()
            ->bladeThemes($themes);
    }
}

if (! function_exists('bladeTheme')) {
    function bladeTheme(string $type, string|array|null $theme = null)
    {
        return DefaultThemeManager::make()
            ->bladeTheme($type, $theme);
    }
}

if (! function_exists('resolveTheme')) {
    function resolveTheme(array $styleGroup, string|ThemeBag $style): string
    {
        return DefaultThemeManager::make()
            ->resolveTheme($styleGroup, $style);
    }
}
