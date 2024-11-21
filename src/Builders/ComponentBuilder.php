<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\ExtraParamsComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\MainBackendComponent;

class ComponentBuilder implements StaticBuilder
{
    public static function make(
        string|BackedEnum $name
    ): BackendComponent|ContentComponent|ThemeComponent|SlotsComponent|LivewireComponent|ExtraParamsComponent {
        return new MainBackendComponent($name);
    }
}
