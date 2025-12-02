<?php

namespace Tests\Themes\Managers;

use ChatAgency\BackendComponents\Concerns\IsThemeManager;

class TestThemeManager
{
    use IsThemeManager;

    private ?string $defaultPath = null;

    public function __construct()
    {
        
    }
}
