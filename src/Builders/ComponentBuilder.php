<?php

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\ExtraParamsComponent;
use ChatAgency\BackendComponents\Contracts\SubComponentsComponent;

class ComponentBuilder implements StaticBuilder
{
    public static function make(
        string | BackedEnum $name,
        ThemeManager | null $themeManager = null
    ) : BackendComponent | ContentComponent | SubComponentsComponent | ThemeComponent | SlotsComponent | LivewireComponent | ExtraParamsComponent
    {
        return new MainBackendComponent($name, $themeManager ?? new DefaultThemeManager);
    }
}
