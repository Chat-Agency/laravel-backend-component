<?php

namespace ChatAgency\LaravelBackendComponents\Contracts;

use ChatAgency\LaravelBackendComponents\Enums\ComponentsEnum;

interface StaticBuilder
{
    public static function make(string | ComponentsEnum $name, ThemeManager | null $themeManager = null) : BackendComponent;
}
