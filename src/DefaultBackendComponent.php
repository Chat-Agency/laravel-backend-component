<?php

namespace ChatAgency\LaravelBackendComponents;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeBag;
use ChatAgency\LaravelBackendComponents\Enums\ComponentsEnum;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeManager;
use ChatAgency\LaravelBackendComponents\Themes\DefaultThemeManager;
use ChatAgency\LaravelBackendComponents\Contracts\BackendComponent;

class DefaultBackendComponent implements Arrayable, Htmlable, BackendComponent
{
    protected string | null $path = null;

    protected bool $useLocal = false;

    protected string | DefaultBackendComponent | null $value = null;

    protected array $attributes = [];

    protected array $subComponents = [];

    protected array $themes = [];

    protected array $extras = [];

    protected bool $isLiveWire = false;

    protected ?string $livewireKey = null;

    protected array $livewireParams = [];

    public function __construct(
        protected string | ComponentsEnum $name,
        protected ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function useLocal($local = true) : self
    {
        $this->useLocal = $local;

        return $this;
    }

    public function getName()
    {
        $name = $this->name;
        
        if ($name instanceof ComponentsEnum) {
            return $name->value;
        }
        
        return $this->name;
    }

    public function getNamespace() : string | null
    {
        return $this->useLocal ? null : \BackendComponentNamespace();
    }

    public function getPath() : string
    {
        return config('laravel-backend-component.path') ?? $this->getNamespace().$this->path;
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

    public function getLivewireKey() : ?string
    {
        return $this->livewireKey;
    }

    public function getValue() : string| DefaultBackendComponent |null
    {
        return $this->value;
    }

    public function getAttributes() : array
    {
        return $this->attributes;
    }

    public function getAttribute(string $name) : ?string
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

    public function setContext(string $path) : self
    {
        $this->path = $path;

        return $this;
    }

    public function setType(?string $name = null) : self
    {
        $this->name = $name;

        return $this;
    }

    public function setValue(string|DefaultBackendComponent $value) : self
    {
        $this->value = $value;

        return $this;
    }

    public function setAttribute(string $name, $value) : self
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    public function setAttributes(array $attributes) : self
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }

        return $this;
    }

    public function setSubComponent($name, DefaultBackendComponent $subComponent) : self
    {
        $this->subComponents[$name] = $subComponent;

        return $this;
    }

    public function setSubComponents(array $subComponents) : self
    {
        $this->subComponents = $subComponents;

        return $this;
    }

    public function setTheme(string $name, string|ThemeBag $theme) : self
    {
        $this->themes[$name] = $theme;

        return $this;
    }

    public function setThemes(array $themes) : self
    {
        $this->themes = $themes;

        return $this;
    }

    public function setExtra(string $name, mixed $value) : self
    {
        $this->extras[$name] = $value;

        return $this;
    }

    public function setExtras(array $extras) : self
    {
        foreach ($extras as $name => $value) {
            $this->setExtra($name, $value);
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
            'value' => $this->getValue(),
            'path' => $this->getComponentPath(),
            'attributes' => $this->getAttributes(),
            'sub_components' => $this->getSubComponents(),
            'themes' => [
                'theming' =>  $this->getThemes(),
                'config' => [
                    'manager' => $this->getThemeManager(),
                ],
            ],
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
