<?php

namespace ChatAgency\BackendComponents\Themes;

use ChatAgency\BackendComponents\Concerns\IsThemeManager;
use ChatAgency\BackendComponents\Contracts\ThemeManager;

final class DefaultThemeManager implements ThemeManager
{
    use IsThemeManager;

    protected string $defaultPath = '_themes.tailwind';

    protected bool $useLocal = false;
}
