<?php

namespace ChatAgency\BackendComponents\Themes;

use ChatAgency\BackendComponents\Concerns\IsThemeManager;
use ChatAgency\BackendComponents\Contracts\ThemeManager;

final class LocalThemeManager implements ThemeManager
{
    
    use IsThemeManager;

    protected string $defaultPath = '_themes';

    protected bool $useLocal = true;

    
}
