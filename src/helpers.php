<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents {

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

}
