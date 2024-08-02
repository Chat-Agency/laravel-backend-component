<?php

namespace ChatAgency\LaravelBackendComponents\Contracts;

use ChatAgency\LaravelBackendComponents\Enums\ComponentEnum;
use ChatAgency\LaravelBackendComponents\MainBackendComponent;
use ChatAgency\LaravelBackendComponents\Themes\DefaultThemeManager;

interface BackendComponent {
    
    public function useLocal($local = true) : self;

    public function getName() : string;

    public function getNamespace() : string | null;

    public function getPath() : string;

    public function getComponentPath() : string;

    public function setLivewire(bool $livewire = true) : self;

    public function isLivewire() : bool;

    public function setLivewireKey(string $livewireKey) : self;

    public function getLivewireKey() : string | null;
    
    public function getValue() : string| MainBackendComponent |null;

    public function getAttributes() : array;

    public function getAttribute(string $name) : string | null;

    public function getSubComponents() : array;

    public function getThemes() : array;

    public function getTheme(string $name) : string| ThemeBag | null;

    public function getExtras() : array;

    public function getExtra(string $name) : mixed;

    public function getThemeManager() : ThemeManager;

    public function getLivewireParams() : array;

    public function setNamespace(string $namespace) : self;

    public function setPath(string $path) : self;

    public function setType(?string $name = null) : self;

    public function setValue(string|MainBackendComponent $value) : self;

    public function setAttribute(string $name, $value) : self;

    public function setAttributes(array $attributes) : self;

    public function setSubComponent($name, MainBackendComponent $subComponent) : self;

    public function setSubComponents(array $subComponents) : self;

    public function setTheme(string $name, string|ThemeBag $theme) : self;

    public function setThemes(array $themes) : self;

    public function setExtra(string $name, mixed $value) : self;

    public function setExtras(array $extras) : self;

    public function setLivewireParams(array $livewireParams) : self;

    public function setThemeManager(ThemeManager $themeManager) : self;
    
    public function toArray() : array;

    public function __toString() : string;

    public function toHtml();
}
