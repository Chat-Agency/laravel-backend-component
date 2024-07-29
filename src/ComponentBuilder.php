<?php

namespace ChatAgency\LaravelBackendComponents;

use BackedEnum;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeManager;
use ChatAgency\LaravelBackendComponents\Contracts\StaticBuilder;
use ChatAgency\LaravelBackendComponents\Contracts\BackendComponent;
use ChatAgency\LaravelBackendComponents\Themes\DefaultThemeManager;

class ComponentBuilder implements StaticBuilder
{
    public static function make(
        string | BackedEnum $name,
        ThemeManager | null $themeManager = null
    ) : BackendComponent
    {
        return new MainBackendComponent($name, $themeManager ?? new DefaultThemeManager);
    }
}
