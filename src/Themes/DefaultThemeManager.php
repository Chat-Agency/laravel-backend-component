<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Themes;

use ChatAgency\BackendComponents\Concerns\IsThemeManager;
use ChatAgency\BackendComponents\Contracts\ThemeManager;

final class DefaultThemeManager implements ThemeManager
{
    use IsThemeManager;

    private ?string $defaultPath = null;

    public function __construct()
    {
        $this->setDefaultPath(__DIR__.'/../../resources/views/_themes/tailwind');
    }
}
