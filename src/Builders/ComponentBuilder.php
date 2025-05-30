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
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

class ComponentBuilder implements StaticBuilder
{
    public static function make(string|BackedEnum $name): Arrayable|BackendComponent|ContentComponent|Htmlable|LivewireComponent|PathComponent|SettingsComponent|SlotsComponent|ThemeComponent
    {
        return new MainBackendComponent($name);
    }
}
