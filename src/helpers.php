<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents {

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

    function processThemes(array $themes, ThemeManager $manager = new DefaultThemeManager): ?string
    {
        return $manager->processThemes(themes: $themes);
    }

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

    function isComponent($component): bool
    {
        return $component instanceof BackendComponent ? true : false;
    }
}
