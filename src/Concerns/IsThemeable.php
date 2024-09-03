<?php

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\ThemeBag;
use ChatAgency\BackendComponents\Contracts\ThemeManager;

trait IsThemeable
{
    protected array $themes = [];

    public function getThemes() : array
    {
        return $this->themes;
    }

    public function getTheme(string $name) : string| ThemeBag |null
    {
        return $this->getThemes()[$name] ?? null;
    }

    public function getThemeManager() : ThemeManager
    {
        return $this->themeManager;
    }

    public function setTheme(string $name, string|ThemeBag $theme) : static
    {
        $this->themes[$name] = $theme;

        return $this;
    }

    public function setThemes(array $themes) : static
    {
        foreach($themes as $name => $theme) {
            $this->setTheme($name, $theme);
        }

        return $this;
    }

    public function setThemeManager(ThemeManager $themeManager) : static
    {
        $this->themeManager = $themeManager;

        return $this;
    }

    public function compileTheme() : string | null
    {
        return $this->getThemeManager()
            ->bladeThemes(
                $this->getThemes()
            );
    }
    
}