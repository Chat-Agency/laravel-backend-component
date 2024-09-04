<?php

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\ThemeBag;
use Illuminate\Support\Str;

trait IsThemeManager
{
    public static function make(): static
    {
        return new static;
    }

    public function useLocal($local = true): static
    {
        $this->useLocal = $local;

        return $this;
    }

    public function getThemePath(): string
    {
        return ($this->useLocal ? null : backendComponentNamespace())
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
            $classes .= $this->bladeTheme($type, $theme).' ';
        }

        return trim($classes);
    }

    public function bladeTheme(string $type, string|ThemeBag|null $theme = null)
    {
        $themePath = $this->getThemePath();

        return trim(
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
