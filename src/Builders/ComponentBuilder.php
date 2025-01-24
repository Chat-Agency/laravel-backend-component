<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\MainBackendComponent;

class ComponentBuilder implements StaticBuilder
{
    public static function make(
        string|BackedEnum $name
    ): MainBackendComponent {
        return new MainBackendComponent($name);
    }
}
