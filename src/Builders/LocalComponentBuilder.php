<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ChildrenComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\ExtraParamsComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

/**
 * Sets component's and theme's path
 * to the local view folder:
 *
 * component - resource/views/components
 * themes - resource/views/_themes
 */
class LocalComponentBuilder implements StaticBuilder
{
    public static function make(
        string|BackedEnum $name,
        ?ThemeManager $themeManager = null
    ): BackendComponent|ContentComponent|ChildrenComponent|ThemeComponent|SlotsComponent|LivewireComponent|ExtraParamsComponent {

        $themes = $themeManager ?? (new DefaultThemeManager)->useLocal();

        $component = (new MainBackendComponent($name, $themes))
            ->useLocal();

        return $component;
    }
}
