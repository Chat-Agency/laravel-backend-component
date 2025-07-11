<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Concerns;

use ChatAgency\BackendComponents\Contracts\Cache;
use ChatAgency\BackendComponents\Exceptions\IncorrectThemePathException;
use ChatAgency\BackendComponents\Exceptions\ThemeDoesNotExistsException;
use Exception;

use function ChatAgency\BackendComponents\cache;

trait IsThemeManager
{
    const THEME_CACHE_NAME = 'theme_cache';

    private bool $disableCache = false;

    private int $cacheHits = 0;

    private ?Cache $cache = null;

    public function setDefaultPath(string $path): static
    {
        $this->defaultPath = $path;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDefaultPath(): string
    {
        $path = $this->defaultPath;

        if (! $path) {
            throw new Exception('No Theme folder path was provided', 500);
        }

        return $path;
    }

    /** @throws IncorrectThemePathException */
    public function getThemePath(): string
    {
        $defaultPath = $this->getDefaultPath();
        $path = realpath($defaultPath);

        if (! $path) {
            throw new IncorrectThemePathException("The theme path ({$defaultPath}) is incorrect");
        }

        return $path;
    }

    public function disableCache(bool $disable = true): static
    {
        $this->disableCache = $disable;

        return $this;
    }

    public function getCacheHits(): int
    {
        return $this->cacheHits;
    }

    public function unsetCacheHits(): static
    {
        $this->cacheHits = 0;

        return $this;
    }

    /**
     * @param  array<string, string|array<string, string>>  $themes
     */
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

    /**
     * @param  string|array<int|string, string>  $theme
     *
     * @throws ThemeDoesNotExistsException
     */
    public function processTheme(string $type, string|array $theme): string
    {
        $themePath = $this->getThemePath();

        if (! $this->cache) {
            $this->cache = cache(self::THEME_CACHE_NAME);
        }

        $cache = $this->cache;
        $cacheKey = $this->resolveCacheKey($type, $theme);

        if (! $this->disableCache && $cache->has($cacheKey)) {

            $this->cacheHits++;

            return $cache->get($cacheKey);
        }

        $filePath = $themePath.'/'.$type.'.blade.php';

        $realPath = realpath($filePath);

        if (! $realPath) {
            throw new ThemeDoesNotExistsException('The theme file '.$filePath.' does not exist');
        }

        $themesArray = require $realPath;

        $theme = $this->resolveTheme($themesArray, $theme);

        if (! $this->disableCache) {
            $cache->set($cacheKey, $theme);
        }

        return $theme;

    }

    /**
     * @param  array<string, string>  $styleGroup
     * @param  string|array<int|string, string>  $theme
     */
    public function resolveTheme(array $styleGroup, string|array $theme): string
    {
        $value = '';

        if (is_string($theme)) {

            $value = $styleGroup[$theme];

        } elseif (is_array($theme)) {

            $value .= $this->resolveArrayThemes($styleGroup, $theme);

        }

        return $value;
    }

    /**
     * @param  array<string, string>  $styleGroup
     * @param  array<int|string, string>  $theme
     */
    public function resolveArrayThemes(array $styleGroup, array $theme): string
    {
        $value = '';

        foreach ($theme as $style) {
            $value .= $styleGroup[$style].' ';
        }

        return $value;
    }

    /**
     * @param  string|array<int|string, string>  $theme
     */
    private function resolveCacheKey(string $type, string|array $theme): string
    {

        if (is_array($theme)) {
            return $type.'.'.implode('.', $theme);
        }

        return $type.'.'.$theme;
    }
}
