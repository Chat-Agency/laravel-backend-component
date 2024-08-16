<?php

namespace ChatAgency\BackendComponents;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;

class MainBackendComponent implements Arrayable, Htmlable, BackendComponent
{
    use IsBackendComponent;
    
    public function __construct(
        protected string | BackedEnum $name,
        protected ThemeManager $themeManager = new DefaultThemeManager
    ) {}

}
