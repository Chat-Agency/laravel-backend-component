<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Themes\LocalThemeManager;

/**
 * Sets theme's path
 * to the local view folder:
 *
 * themes - resource/views/_themes
 */
class LocalThemeComponentBuilder implements StaticBuilder
{
    public static function make(
        string|BackedEnum $name
    ): MainBackendComponent {

        $component = new MainBackendComponent($name, new LocalThemeManager);

        return $component;
    }
}
