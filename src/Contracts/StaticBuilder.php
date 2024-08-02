<?php

namespace ChatAgency\LaravelBackendComponents\Contracts;

use ChatAgency\LaravelBackendComponents\Enums\ComponentEnum;

interface StaticBuilder
{
    public static function make(string | ComponentEnum $name, ThemeManager | null $themeManager = null) : BackendComponent;
}
