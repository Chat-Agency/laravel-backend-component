<?php

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

/**
 * Sets theme's path 
 * to the local view folder:
 * 
 * themes - resource/views/_themes
 */
class LocalThemeBuilder implements StaticBuilder
{
    public static function make(
        string | BackedEnum $name,
        ThemeManager | null $themeManager = null
    ) : BackendComponent
    {
        
        $themes = $themeManager ?? (new DefaultThemeManager)->useLocal();

        $component = (new MainBackendComponent($name, $themes));
        

        return  $component;
    }
}
