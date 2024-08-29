<?php

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\Contracts\ThemeBag;

interface ThemeComponent
{
    public function setTheme(string $name, string|ThemeBag $theme) : static;
    
    public function setThemes(array $themes) : static;

    public function setThemeManager(ThemeManager $themeManager) : static;

    public function getThemes() : array;

    public function getTheme(string $name) : string| ThemeBag | null;

    public function getThemeManager() : ThemeManager;

    public function compileTheme() : string | null;

}
