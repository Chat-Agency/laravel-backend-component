<?php

namespace ChatAgency\BackendComponents\Concerns;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\ThemeBag;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\BackendComponent;

trait IsBackendComponent
{
    /**
     * Package namespace
     */
    protected string | null $namespace = null;

    protected string | null $path = null;

    protected bool $useLocal = false;

    protected string | BackendComponent | null $content = null;

    protected array $attributes = [];

    /** @var BackendComponent[] $subComponents */
    protected array $subComponents = [];

    protected array $themes = [];

    protected array $slots = [];

    protected array $extras = [];

    protected bool $isLiveWire = false;

    protected ?string $livewireKey = null;

    protected array $livewireParams = [];

    public function useLocal($local = true) : static
    {
        $this->useLocal = $local;

        return $this;
    }

    public function getName() : string
    {
        $name = $this->name;
        
        if ($name instanceof BackedEnum) {
            return $name->value;
        }
        
        return $name;
    }

    public function getNamespace() : string | null
    {
        return $this->useLocal 
            ? null : 
            ($this->namespace ?? \BackendComponentNamespace());
    }

    public function getPath() : string
    {
        return $this->getNamespace().$this->path;
    }

    public function getComponentPath() : string
    {
        return $this->getPath().$this->getName();
    }

    public function setLivewire(bool $livewire = true) : static
    {
        $this->isLiveWire = $livewire;

        return $this;
    }

    public function isLivewire() : bool
    {
        return $this->isLiveWire;
    }

    public function setLivewireKey(string $livewireKey) : static
    {
        $this->livewireKey = $livewireKey;

        return $this;
    }

    public function getLivewireKey() : string | null
    {
        return $this->livewireKey;
    }

    public function getContent() : string| BackendComponent |null
    {
        return $this->content;
    }

    public function getAttributes() : array
    {
        return $this->attributes;
    }

    public function getAttribute(string $name) : string | null
    {
        return $this->getAttributes()[$name] ?? null;
    }

    public function getSubComponents() : array
    {
        return $this->subComponents;
    }

    public function getThemes() : array
    {
        return $this->themes;
    }

    public function getTheme(string $name) : string| ThemeBag |null
    {
        return $this->getThemes()[$name] ?? null;
    }


    public function getSlots() : array
    {
        return $this->slots;
    }

    public function getSlot(string $name) : BackendComponent
    {
        return $this->getSlots()[$name] ?? null;
    }

    public function getExtras() : array
    {
        return $this->extras;
    }

    public function getExtra(string $name) : mixed
    {
        return $this->getExtras()[$name] ?? null;
    }

    public function getThemeManager() : ThemeManager
    {
        return $this->themeManager;
    }

    public function getLivewireParams() : array
    {
        return $this->livewireParams;
    }

    public function setNamespace(string $namespace) : static
    {
        $this->namespace = $namespace;

        return $this;
    }
    
    public function setPath(string $path) : static
    {
        $this->path = $path;

        return $this;
    }
    
    public function setType(?string $name = null) : static
    {
        $this->name = $name;

        return $this;
    }

    public function setContent(string|BackendComponent $content) : static
    {
        $this->content = $content;

        return $this;
    }

    public function setAttribute(string $name, $content) : static
    {
        $this->attributes[$name] = $content;

        return $this;
    }

    public function setAttributes(array $attributes) : static
    {
        foreach ($attributes as $name => $content) {
            $this->setAttribute($name, $content);
        }

        return $this;
    }

    public function setSubComponent(BackendComponent $subComponent, string $name = null) : static
    {
        if($name) {
            $this->subComponents[$name] = $subComponent;
            return $this;
        }

        $this->subComponents[] = $subComponent;

        return $this;
    }

    public function setSubComponents(array $subComponents) : static
    {
        foreach($subComponents as $name => $subComponent) {
            $this->setSubComponent($subComponent, $name);
        }

        return $this;
    }

    public function setTheme(string $name, string|ThemeBag $theme) : static
    {
        $this->themes[$name] = $theme;

        return $this;
    }

    public function setThemes(array $themes) : static
    {
        foreach($themes as $name => $theme) {
            $this->setTheme($name, $theme);
        }

        return $this;
    }
    public function setSlot(string $name, BackendComponent $slot) : static
    {
        $this->slots[$name] = $slot;

        return $this;
    }

    public function setSlots(array $slots) : static
    {
        foreach($slots as $name => $slot) {
            $this->setSlot($name, $slot);
        }

        return $this;
    }

    public function setExtra(string $name, mixed $content) : static
    {
        $this->extras[$name] = $content;

        return $this;
    }

    public function setExtras(array $extras) : static
    {
        foreach ($extras as $name => $content) {
            $this->setExtra($name, $content);
        }

        return $this;
    }

    public function setLivewireParams(array $livewireParams) : static
    {
        $this->livewireParams = $livewireParams;

        return $this;
    }
    
    public function setThemeManager(ThemeManager $themeManager) : static
    {
        $this->themeManager = $themeManager;

        return $this;
    }
    
    public function toArray() : array
    {
        return [
            'name' => $this->getName(),
            'content' => $this->getContent(),
            'path' => $this->getComponentPath(),
            'attributes' => $this->getAttributes(),
            'sub_components' => $this->getSubComponents(),
            'themes' => $this->getThemeManager()
                ->bladeThemes(
                    $this->getThemes()
                ),
            'slots' => $this->getSlots(),
            'extra' => $this->getExtras(),
            'is_livewire' => $this->isLivewire(),
            'livewire_key' => $this->getLivewireKey(),
            'livewire_params' => $this->getLivewireParams(),
        ];
    }

    public function __toString() : string
    {
        /**
         * Convert theme manager instance
         * to class string
         */
        $component = $this->toArray();
        $themeManager = $this->getThemeManager();
        $component['themes']['config']['manager'] = $themeManager::class;
        
        return json_encode($component);
    }

    public function toHtml()
    {
        return view(\BackendComponentNamespace().'_utilities.resolve-component')
            ->with('component', $this);

    }
}
