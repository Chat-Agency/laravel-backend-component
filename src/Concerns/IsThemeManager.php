<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\ThemeBag;

use function ChatAgency\BackendComponents\cache;

trait IsThemeManager
{
    protected $disableCache = false;

    public function setDefaultPath(string $path): static
    {
        $this->defaultPath = $path;

        return $this;
    }

    public function getDefaultPath(): string
    {
        return $this->defaultPath;
    }

    public function getThemePath(): string
    {
        $defaultPath = $this->defaultPath;
        $path = realpath($defaultPath);

        if (! $path) {
            throw new \Exception("The theme path ({$defaultPath}) is incorrect", 500);
        }

        return $path;
    }

    public function disableCache(bool $disable = true): static
    {
        $this->disableCache = $disable;

        return $this;
    }

    public function processThemes(array $themes): ?string
    {
        if (! count($themes)) {
            return null;
        }

        $classes = '';

        foreach ($themes as $type => $theme) {
            $classes .= $this->processTheme($type, $theme).' ';
        }

        return trim($classes);
    }

    public function processTheme(string $type, string|array|ThemeBag|null $theme = null): ?string
    {
        $themePath = $this->getThemePath();
        $cache = cache();
        $cacheKey = $this->resolveCacheKey($type, $theme);

        if (! $this->disableCache && $cache->has($cacheKey)) {
            return $cache->get($cacheKey);
        }

        $filePath = $themePath.'/'.$type.'.blade.php';

        $realPath = realpath($filePath);

        if (! $realPath) {
            throw new \Exception('The theme file '.$filePath.' does not exist', 500);
        }

        $themesArray = require $realPath;

        $theme = $this->resolveTheme($themesArray, $theme);

        if (! $this->disableCache) {
            $cache->set($cacheKey, $theme);
        }

        return $theme;

    }

    public function resolveTheme(array $styleGroup, string|array|ThemeBag $style): string
    {
        $value = '';

        if ($this->isBag($style)) {

            foreach ($style->getStyles() as $styleValue) {

                if (is_array($styleValue)) {
                    $value .= $this->resolveArrayThemes($styleGroup, $styleValue);

                    continue;
                }

                $value .= $styleGroup[$styleValue].' ';
            }

        } elseif (is_array($style)) {

            $value .= $this->resolveArrayThemes($styleGroup, $style);

        } elseif (is_string($style)) {
            $value = $styleGroup[$style];
        }

        return $value;
    }

    public function isBag(string|array|ThemeBag $value): bool
    {
        return is_a($value, ThemeBag::class);
    }

    public function resolveArrayThemes(array $styleGroup, array $styles): string
    {
        $value = '';

        foreach ($styles as $style) {
            $value .= $styleGroup[$style].' ';
        }

        return $value;
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
