<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;

interface StaticBuilder
{
    public static function make(string|ComponentEnum $name): MainBackendComponent;
}
