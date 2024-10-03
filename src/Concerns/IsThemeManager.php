<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\ThemeBag;

use function ChatAgency\BackendComponents\cache;

trait IsThemeManager
{
    public static function make(): static
    {
        return new static;
    }

    public function useLocal($local = true): static
    {
        $this->setPath(resource_path('_themes/tailwind/'));

        return $this;
    }

    public function setPath(string $path): static
    {
        $this->defaultPath = $path;

        return $this;
    }

    public function getRawPath(): string
    {
        return $this->defaultPath;
    }

    public function getThemePath(): string
    {
        $path = realpath($this->defaultPath);

        if (! $path) {
            throw new \Exception('The theme path is incorrect', 500);
        }

        return $path;
    }

    public function getThemes(array $themes)
    {
        if (! count($themes)) {
            return null;
        }

        $classes = '';

        foreach ($themes as $type => $theme) {
            $classes .= $this->getTheme($type, $theme).' ';
        }

        return trim($classes);
    }

    public function getTheme(string $type, string|array|ThemeBag|null $theme = null): string
    {
        $themePath = $this->getThemePath();
        $cache = cache();
        $cacheKey = $this->resolveCacheKey($type, $theme);

        if($cache->has($cacheKey)) {
            return $cache->get($cacheKey);
        }

        $filePath = $themePath.'/'.$type.'.blade.php';

        $realPath = realpath($filePath);

        if (! $realPath) {
            throw new \Exception('The theme file '.$filePath.' does not exist', 500);
        }

        $themesArray = require $realPath;

        $theme = $this->resolveTheme($themesArray, $theme);
        
        $cache->set($cacheKey, $theme);

        return $theme;

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

    private function resolveCacheKey(string $type, string|array|ThemeBag|null $theme): string
    {
        if (is_string($theme)) {
            return $type.$theme;
        }

        if (is_array($theme)) {
            return $type.implode('.', $theme);
        }

        return $type.implode('.', $theme->getStyles());
    }
}
