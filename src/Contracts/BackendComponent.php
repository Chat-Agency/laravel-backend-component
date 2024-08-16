<?php

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\MainBackendComponent;

interface BackendComponent {
    
    public function useLocal($local = true) : static;

    public function getName() : string;

    public function getNamespace() : string | null;

    public function getPath() : string;

    public function getComponentPath() : string;

    public function setLivewire(bool $livewire = true) : static;

    public function isLivewire() : bool;

    public function setLivewireKey(string $livewireKey) : static;

    public function getLivewireKey() : string | null;
    
    public function getContent() : string| MainBackendComponent |null;

    public function getAttributes() : array;

    public function getAttribute(string $name) : string | null;

    public function getSubComponents() : array;

    public function getThemes() : array;

    public function getTheme(string $name) : string| ThemeBag | null;
    public function getSlots() : array;

    public function getSlot(string $name) : BackendComponent;
    
    public function getExtras() : array;

    public function getExtra(string $name) : mixed;

    public function getThemeManager() : ThemeManager;

    public function getLivewireParams() : array;

    public function setNamespace(string $namespace) : static;

    public function setPath(string $path) : static;

    public function setType(?string $name = null) : static;

    public function setContent(string|MainBackendComponent $content) : static;

    public function setAttribute(string $name, $content) : static;

    public function setAttributes(array $attributes) : static;

    public function setSubComponent(MainBackendComponent $subComponent, string $name = null) : static;

    public function setSubComponents(array $subComponents) : static;

    public function setTheme(string $name, string|ThemeBag $theme) : static;
    public function setSlot(string $name, BackendComponent $slot) : static;

    public function setSlots(array $slots) : static;
    
    public function setThemes(array $themes) : static;

    public function setExtra(string $name, mixed $content) : static;

    public function setExtras(array $extras) : static;

    public function setLivewireParams(array $livewireParams) : static;

    public function setThemeManager(ThemeManager $themeManager) : static;
    
    public function toArray() : array;

    public function __toString() : string;

    public function toHtml();
}
