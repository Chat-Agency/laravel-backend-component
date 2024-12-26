<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents {

    use ChatAgency\BackendComponents\Cache\DefaultCache;
    use ChatAgency\BackendComponents\Contracts\BackendComponent;
    use ChatAgency\BackendComponents\Contracts\ThemeManager;
    use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

    function backendComponentNamespace(): string
    {
        return BackendComponentsServiceProvider::namespace().'::';
    }

    function makeBackendComponent(string|\BackedEnum $name): MainBackendComponent
    {
        return new MainBackendComponent($name);
    }

    function getThemes(array $themes, ThemeManager $manager = new DefaultThemeManager)
    {
        return $manager->getThemes($themes);
    }

    function cache(): DefaultCache
    {

        static $cache;

        if ($cache === null) {
            $cache = new DefaultCache;
        }

        return $cache;

    }

    function isComponent($component): bool
    {
        return $component instanceof BackendComponent ? true : false;
    }
}
