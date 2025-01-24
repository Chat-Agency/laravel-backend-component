<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Themes;

use ChatAgency\BackendComponents\Concerns\IsThemeManager;
use ChatAgency\BackendComponents\Contracts\ThemeManager;

final class LocalThemeManager implements ThemeManager
{
    use IsThemeManager;

    private string $defaultPath = '_themes';
}
