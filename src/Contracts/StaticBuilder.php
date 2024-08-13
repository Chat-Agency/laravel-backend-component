<?php

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\Enums\ComponentEnum;

interface StaticBuilder
{
    public static function make(string | ComponentEnum $name, ThemeManager | null $themeManager = null) : BackendComponent;
}
