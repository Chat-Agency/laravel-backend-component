<?php

namespace ChatAgency\LaravelBackendComponents\Themes;

use ChatAgency\LaravelBackendComponents\Concerns\ThemeBag;
use ChatAgency\LaravelBackendComponents\Concerns\ThemeManager;
use Illuminate\Support\Str;

class DefaultThemeManager implements ThemeManager
{
    protected string $defaultPath = '_themes.tailwind';

    public static function make(): self
    {
        return new static();
    }

    public function getThemePath(): string
    {
        return config('themes.path')
            ?? BackendComponentNamespace()
                .$this->defaultPath
                .'.';
    }

    public function bladeThemes(array $themes)
    {
        if (! count($themes)) {
            return null;
        }

        $classes = '';

        foreach ($themes as $type => $theme) {
            $classes .= $this->bladeTheme($type, $theme);
        }

        return $classes;
    }

    public function bladeTheme(string $type, string|ThemeBag|null $theme = null)
    {
        $themePath = $this->getThemePath();

        return ' '.trim(
            view($themePath.$type)
                ->with(Str::camel($type), $theme)
                ->render()
        );
    }

    public function resolveTheme(array $styleGroup, string|ThemeBag $style): string
    {
        $value = '';

        if ($this->isBag($style)) {

            foreach ($style->getStyles() as $styleValue) {

                if (is_array($styleValue)) {
                    foreach ($styleValue as $key => $styleArrayValue) {
                        $value .= $styleGroup[$styleArrayValue].' ';
                    }

                    continue;
                }

                $value .= $styleGroup[$styleValue].' ';

            }

        } elseif (is_string($style)) {
            $value = $styleGroup[$style] ?? '';
        }

        return $value;
    }

    public function isBag(string|ThemeBag $value): bool
    {
        return is_a($value, ThemeBag::class);
    }
}
