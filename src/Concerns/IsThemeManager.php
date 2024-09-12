<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\ThemeBag;
use Illuminate\Support\Str;

use function ChatAgency\BackendComponents\backendComponentNamespace;

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

    public function bladeTheme(string $type, string|array|ThemeBag|null $theme = null): string
    {
        $themePath = $this->getThemePath();

        return trim(
            view($themePath.$type)
                ->with(Str::camel($type), $theme)
                ->render()
        );
    }

    public function resolveTheme(array $styleGroup, string|array|ThemeBag $style): string
    {
        $value = '';

        if ($this->isBag($style)) {

            foreach ($style->getStyles() as $styleValue) {
                $value .= $styleGroup[$styleValue].' ';
            }

        } elseif (is_array($style)) {

            foreach ($style as $styleArrayValue) {
                $value .= $styleGroup[$styleArrayValue].' ';
            }

        } elseif (is_string($style)) {
            $value = $styleGroup[$style] ?? '';
        }

        return $value;
    }

    public function isBag(string|array|ThemeBag $value): bool
    {
        return is_a($value, ThemeBag::class);
    }
}
