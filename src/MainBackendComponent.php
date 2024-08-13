<?php

namespace ChatAgency\BackendComponents;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;
use ChatAgency\BackendComponents\Contracts\ThemeBag;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

class MainBackendComponent implements Arrayable, Htmlable, BackendComponent
{
    /**
     * Package namespace
     */
    protected string | null $namespace = null;

    protected string | null $path = null;

    protected bool $useLocal = false;

    protected string | MainBackendComponent | null $content = null;

    protected array $attributes = [];

    protected array $subComponents = [];

    protected array $themes = [];

    protected array $slots = [];

    protected array $extras = [];

    protected bool $isLiveWire = false;

    protected ?string $livewireKey = null;

    protected array $livewireParams = [];

    public function __construct(
        protected string | BackedEnum $name,
        protected ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function useLocal($local = true) : self
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

    public function setLivewire(bool $livewire = true) : self
    {
        $this->isLiveWire = $livewire;

        return $this;
    }

    public function isLivewire() : bool
    {
        return $this->isLiveWire;
    }

    public function setLivewireKey(string $livewireKey) : self
    {
        $this->livewireKey = $livewireKey;

        return $this;
    }

    public function getLivewireKey() : string | null
    {
        return $this->livewireKey;
    }

    public function getContent() : string| MainBackendComponent |null
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

    public function setNamespace(string $namespace) : self
    {
        $this->namespace = $namespace;

        return $this;
    }
    
    public function setPath(string $path) : self
    {
        $this->path = $path;

        return $this;
    }
    
    public function setType(?string $name = null) : self
    {
        $this->name = $name;

        return $this;
    }

    public function setContent(string|MainBackendComponent $content) : self
    {
        $this->content = $content;

        return $this;
    }

    public function setAttribute(string $name, $content) : self
    {
        $this->attributes[$name] = $content;

        return $this;
    }

    public function setAttributes(array $attributes) : self
    {
        foreach ($attributes as $name => $content) {
            $this->setAttribute($name, $content);
        }

        return $this;
    }

    public function setSubComponent(MainBackendComponent $subComponent, string $name = null) : self
    {
        if($name) {
            $this->subComponents[$name] = $subComponent;
            return $this;
        }

        $this->subComponents[] = $subComponent;

        return $this;
    }

    public function setSubComponents(array $subComponents) : self
    {
        foreach($subComponents as $name => $subComponent) {
            $this->setSubComponent($subComponent, $name);
        }

        return $this;
    }

    public function setTheme(string $name, string|ThemeBag $theme) : self
    {
        $this->themes[$name] = $theme;

        return $this;
    }

    public function setThemes(array $themes) : self
    {
        foreach($themes as $name => $theme) {
            $this->setTheme($name, $theme);
        }

        return $this;
    }
    public function setSlot(string $name, BackendComponent $slot) : self
    {
        $this->slots[$name] = $slot;

        return $this;
    }

    public function setSlots(array $slots) : self
    {
        foreach($slots as $name => $slot) {
            $this->setSlot($name, $slot);
        }

        return $this;
    }

    public function setExtra(string $name, mixed $content) : self
    {
        $this->extras[$name] = $content;

        return $this;
    }

    public function setExtras(array $extras) : self
    {
        foreach ($extras as $name => $content) {
            $this->setExtra($name, $content);
        }

        return $this;
    }

    public function setLivewireParams(array $livewireParams) : self
    {
        $this->livewireParams = $livewireParams;

        return $this;
    }
    
    public function setThemeManager(ThemeManager $themeManager) : self
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
