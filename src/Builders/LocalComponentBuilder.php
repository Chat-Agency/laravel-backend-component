<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Themes\LocalThemeManager;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Sets component's and theme's path
 * to the local view folder:
 *
 * component - resource/views/components
 * themes - resource/views/_themes
 */
class LocalComponentBuilder implements StaticBuilder
{
    public static function make(string|BackedEnum $name): Htmlable|CompoundComponent
    {

        $component = (new MainBackendComponent($name, new LocalThemeManager))
            ->useLocal();

        return $component;
    }
}
