<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\PathComponent;
use ChatAgency\BackendComponents\Contracts\SettingsComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Themes\LocalThemeManager;
use Illuminate\Contracts\Support\Arrayable;
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
    public static function make(string|BackedEnum $name): Arrayable|BackendComponent|ContentComponent|Htmlable|LivewireComponent|PathComponent|SettingsComponent|SlotsComponent|ThemeComponent
    {

        $component = (new MainBackendComponent($name, new LocalThemeManager))
            ->useLocal();

        return $component;
    }
}
