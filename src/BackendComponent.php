<?php

namespace ChatAgency\LaravelBackendComponents;

use ChatAgency\LaravelBackendComponents\Concerns\LaravelBackendComponent;
use ChatAgency\LaravelBackendComponents\Concerns\ThemeBag;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

class BackendComponent implements Arrayable, Htmlable, LaravelBackendComponent
{
    protected string $context = 'dynamic.';

    protected string|BackendComponent|null $value = null;

    protected array $attributes = [];

    protected array $subComponents = [];

    protected array $themes = [];

    protected array $extras = [];

    protected bool $isLiveWire = false;

    protected ?string $livewireKey = null;

    public function __construct(
        protected string $name
    ) {}

    public static function make($name): static
    {
        return new static($name);
    }

    public function getContext(): string
    {
        return config('laravel-backend-component.context') ?? \BackendComponentNamespace().$this->context;
    }

    public function getPath(): string
    {
        $context = $this->getContext();

        return $context.$this->name;
    }

    public function setLivewire(bool $livewire = true): self
    {
        $this->isLiveWire = $livewire;

        return $this;
    }

    public function isLivewire(): bool
    {
        return $this->isLiveWire;
    }

    public function setLivewireKey(string $livewireKey): self
    {
        $this->livewireKey = $livewireKey;

        return $this;
    }

    public function getLivewireKey(): ?string
    {
        return $this->livewireKey;
    }

    public function getValue(): string|BackendComponent|null
    {
        return $this->value;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $name): ?string
    {
        return $this->getAttributes()[$name] ?? null;
    }

    public function getSubComponents(): array
    {
        return $this->subComponents;
    }

    public function getThemes(): array
    {
        return $this->themes;
    }

    public function getTheme(string $name): string|ThemeBag|null
    {
        return $this->getThemes()[$name] ?? null;
    }

    public function getExtras(): array
    {
        return $this->extras;
    }

    public function getExtra(string $name): mixed
    {
        return $this->getExtras()[$name] ?? null;
    }

    public function setContext(string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function setType(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    public function setValue(string|BackendComponent $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setAttribute(string $name, $value): self
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }

        return $this;
    }

    public function setSubComponent($name, BackendComponent $subComponent): self
    {
        $this->subComponents[$name] = $subComponent;

        return $this;
    }

    public function setSubComponents(array $subComponents): self
    {
        $this->subComponents = $subComponents;

        return $this;
    }

    public function setTheme(string $name, string|ThemeBag $theme): self
    {
        $this->themes[$name] = $theme;

        return $this;
    }

    public function setThemes(array $themes): self
    {
        $this->themes = $themes;

        return $this;
    }

    public function setExtra(string $name, mixed $value): self
    {
        $this->extras[$name] = $value;

        return $this;
    }

    public function setExtras(array $extras): self
    {
        foreach ($extras as $name => $value) {
            $this->setExtra($name, $value);
        }

        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->getValue(),
            'context' => $this->getContext(),
            'path' => $this->getPath(),
            'attributes' => $this->getAttributes(),
            'sub_components' => $this->getSubComponents(),
            'themes' => $this->getThemes(),
            'extra' => $this->getExtras(),
            'is_livewire' => $this->isLivewire(),
            'livewire_key' => $this->getLivewireKey(),
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function toHtml()
    {
        return view(\BackendComponentNamespace().'_utilities.resolve-component')
            ->with('component', $this);

    }
}
