<?php

namespace ChatAgency\LaravelBackendComponents;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeBag;
use ChatAgency\LaravelBackendComponents\Contracts\ThemeManager;
use ChatAgency\LaravelBackendComponents\Contracts\LaravelBackendComponent;

class BackendComponent implements Arrayable, Htmlable, LaravelBackendComponent
{
    protected string $context = 'backend.';

    protected bool $useLocal = false;

    protected string | BackendComponent | null $value = null;

    protected array $attributes = [];

    protected array $subComponents = [];

    protected array $themes = [];

    protected array $extras = [];

    protected bool $isLiveWire = false;

    protected ?string $livewireKey = null;

    public function __construct(
        protected string $name,
        protected ThemeManager | null $themeManager = null
    ) {}

    public static function make($name, ThemeManager | null $themeManager = null) : static
    {
        return new static($name, $themeManager);
    }

    public function useLocal($local = true) : self
    {
        $this->useLocal = $local;

        return $this;
    }

    public function getNamespace() : string | null
    {
        return $this->useLocal ? null : \BackendComponentNamespace();
    }

    public function getContext() : string
    {
        return config('laravel-backend-component.context') ?? $this->getNamespace().$this->context;
    }

    public function getPath() : string
    {
        $context = $this->getContext();

        return $context.$this->name;
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

    public function getValue() : string|BackendComponent|null
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

    public function getTheme(string $name) : string|ThemeBag|null
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

    public function getThemeManager() : ThemeManager | null
    {
        return $this->themeManager;
    }

    public function setContext(string $context) : self
    {
        $this->context = $context;

        return $this;
    }

    public function setType(?string $name = null) : self
    {
        $this->name = $name;

        return $this;
    }

    public function setValue(string|BackendComponent $value) : self
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

    public function setSubComponent($name, BackendComponent $subComponent) : self
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

    public function setThemeManager(ThemeManager $themeManager) : self
    {
        $this->themeManager = $themeManager;

        return $this;
    }
    public function toArray() : array
    {
        return [
            'name' => $this->name,
            'value' => $this->getValue(),
            'context' => $this->getContext(),
            'path' => $this->getPath(),
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
        ];
    }

    public function __toString() : string
    {
        return json_encode($this->toArray());
    }

    public function toHtml()
    {
        return view(\BackendComponentNamespace().'_utilities.resolve-component')
            ->with('component', $this);

    }

}
