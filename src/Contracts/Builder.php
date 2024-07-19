<?php

namespace ChatAgency\LaravelBackendComponents\Contracts;

use ChatAgency\LaravelBackendComponents\Enums\ComponentsEnum;

interface Builder
{
    public static function make(string | ComponentsEnum $name, ThemeManager | null $themeManager = null) : BackendComponent;
}
