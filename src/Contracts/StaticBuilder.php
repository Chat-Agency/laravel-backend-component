<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

interface StaticBuilder
{
    public static function make(string|ComponentEnum $name): Arrayable|BackendComponent|ContentComponent|Htmlable|LivewireComponent|PathComponent|SettingsComponent|SlotsComponent|ThemeComponent;
}
