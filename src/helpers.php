<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents {

use ChatAgency\BackendComponents\Utils\CellBag;

    use BackedEnum;
    use ChatAgency\BackendComponents\Cache\DefaultCache;
    use ChatAgency\BackendComponents\Contracts\BackendComponent;
    use ChatAgency\BackendComponents\Contracts\ThemeManager;
    use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
    use ChatAgency\BackendComponents\Themes\LocalThemeManager;

    function backendComponentNamespace(): string
    {
        return BackendComponentsServiceProvider::namespace().'::';
    }

    function makeBackendComponent(string|\BackedEnum $name, ThemeManager $manager = new DefaultThemeManager): MainBackendComponent
    {
        return new MainBackendComponent(name: $name, themeManager: $manager);
    }

    /**
     * @param  array<string, string|array<string, string>>  $themes
     */
    function processThemes(array $themes, ThemeManager $manager = new DefaultThemeManager): ?string
    {
        return $manager->processThemes(themes: $themes);
    }

    /**
     * @param  array<string, string|array<string, string>> $themes
     */
    function processLocalThemes(array $themes): ?string
    {
        $manager = new LocalThemeManager;

        return $manager->processThemes(themes: $themes);
    }

    function cache(string $name): DefaultCache
    {
        /**
         * @var array<string, DefaultCache>
         */
        static $cache = [];

        if (! isset($cache[$name])) {
            $cache[$name] = new DefaultCache;
        }

        return $cache[$name];

    }

    /** @phpstan-assert-if-true BackendComponent $component */
    function isComponent(mixed $component): bool
    {
        return $component instanceof BackendComponent;
    }

    /** @phpstan-assert-if-true BackedEnum $enum */
    function isBackedEnum(mixed $enum): bool 
    {
        return $enum instanceof BackedEnum;
    }

    /** @phpstan-assert-if-true CellBag $bag */
    function isCellBag(mixed $bag): bool 
    {
        return $bag instanceof CellBag;
    }
}
