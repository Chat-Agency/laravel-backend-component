<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Builders;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\StaticBuilder;
use ChatAgency\BackendComponents\MainBackendComponent;
use Illuminate\Contracts\Support\Htmlable;

class ComponentBuilder implements StaticBuilder
{
    public static function make(string|BackedEnum $name): Htmlable|CompoundComponent
    {
        return new MainBackendComponent($name);
    }
}
