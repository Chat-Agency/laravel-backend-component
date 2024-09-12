<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents {

    use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
    use ChatAgency\BackendComponents\Contracts\AttributeBag;
    use ChatAgency\BackendComponents\Contracts\BackendComponent;
    use ChatAgency\BackendComponents\Contracts\ThemeBag;
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

    function isBackendComponent($value)
    {
        return is_a($value, BackendComponent::class);
    }

    function bladeThemes(array $themes, ThemeManager $manager = new DefaultThemeManager)
    {
        return $manager->bladeThemes($themes);
    }

    function resolveTheme(array $styleGroup, string|array|ThemeBag $style): string
    {
        return DefaultThemeManager::make()
            ->resolveTheme($styleGroup, $style);
    }

    function makeAttributeBag(...$args): AttributeBag
    {
        return new DefaultAttributeBag(...$args);

    }

}
