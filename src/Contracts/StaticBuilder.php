<?php

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\Enums\ComponentEnum;

interface StaticBuilder
{
    public static function make(string|ComponentEnum $name, ?ThemeManager $themeManager = null): BackendComponent|ContentComponent|SubComponentsComponent|ThemeComponent|SlotsComponent|LivewireComponent|ExtraParamsComponent;
}
