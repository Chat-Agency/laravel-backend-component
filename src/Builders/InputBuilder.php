<?php

namespace ChatAgency\LaravelBackendComponents\Builders;

use BackedEnum;
use ChatAgency\LaravelBackendComponents\MainBackendComponent;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeManager;
use ChatAgency\LaravelBackendComponents\Contracts\BackendComponent;
use ChatAgency\LaravelBackendComponents\Themes\DefaultThemeManager;


class InputBuilder 
{
    public static function make(
        string | BackedEnum $name,
        ThemeManager | null $themeManager = null
    ) : BackendComponent
    {
        $component = new MainBackendComponent($name, $themeManager ?? new DefaultThemeManager);

        $component->setPath('inputs.');

        return  $component;
    }
}
