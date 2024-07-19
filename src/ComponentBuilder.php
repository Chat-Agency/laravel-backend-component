<?php

namespace ChatAgency\LaravelBackendComponents;

use ChatAgency\LaravelBackendComponents\Contracts\Builder;
use ChatAgency\LaravelBackendComponents\Enums\ComponentsEnum;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeManager;
use ChatAgency\LaravelBackendComponents\Contracts\BackendComponent;
use ChatAgency\LaravelBackendComponents\Themes\DefaultThemeManager;

class ComponentBuilder implements Builder
{
    public static function make(
        string | ComponentsEnum $name,
        ThemeManager | null $themeManager = null
    ) : BackendComponent
    {
        return new MainBackendComponent($name, $themeManager ?? new DefaultThemeManager);
    }
}
