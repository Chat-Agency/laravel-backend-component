<?php

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;


class TableBuilder implements StaticBuilder
{
    public static function make(
        string | BackedEnum $name,
        ThemeManager | null $themeManager = null
    ) : BackendComponent
    {
        $component = new MainBackendComponent($name, $themeManager ?? new DefaultThemeManager);

        $component->setPath('table.');

        return  $component;
    }
}
