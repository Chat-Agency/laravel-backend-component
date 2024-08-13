<?php

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

/**
 * Sets component's and theme's path 
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
