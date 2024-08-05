<?php

namespace ChatAgency\LaravelBackendComponents\Builders;

use BackedEnum;
use ChatAgency\LaravelBackendComponents\MainBackendComponent;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeManager;
use ChatAgency\LaravelBackendComponents\Contracts\StaticBuilder;
use ChatAgency\LaravelBackendComponents\Contracts\BackendComponent;
use ChatAgency\LaravelBackendComponents\Themes\DefaultThemeManager;

/**
 * Sets component and themes path 
 * to the local view folder:
 * 
 * component - resource/views/components
 * themes - resource/views/_themes
 */
class LocalBuilder implements StaticBuilder
{
    public static function make(
        string | BackedEnum $name,
        ThemeManager | null $themeManager = null
    ) : BackendComponent
    {
        
        $themes = $themeManager ?? (new DefaultThemeManager)->useLocal();

        $component = (new MainBackendComponent($name, $themes))
            ->useLocal();
        

        return  $component;
    }
}
