<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
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
        string|BackedEnum $name
    ): MainBackendComponent {

        $component = (new MainBackendComponent($name, (new DefaultThemeManager)->useLocal()))
            ->useLocal();

        return $component;
    }
}
