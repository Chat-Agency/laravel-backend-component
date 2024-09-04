<?php

namespace ChatAgency\BackendComponents\Themes;

use ChatAgency\BackendComponents\Concerns\IsThemeManager;
use ChatAgency\BackendComponents\Contracts\ThemeBag;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use Illuminate\Support\Str;

final class DefaultThemeManager implements ThemeManager
{
    use IsThemeManager;

    protected string $defaultPath = '_themes.tailwind';

    protected bool $useLocal = false;

    
}
