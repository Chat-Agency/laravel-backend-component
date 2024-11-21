<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\Enums\ComponentEnum;

interface StaticBuilder
{
    public static function make(string|ComponentEnum $name): BackendComponent|ContentComponent|ThemeComponent|SlotsComponent|LivewireComponent|ExtraParamsComponent;
}
