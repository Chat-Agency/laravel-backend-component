<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents;

use BackedEnum;
use ChatAgency\BackendComponents\Concerns\HasContent;
use ChatAgency\BackendComponents\Concerns\HasPath;
use ChatAgency\BackendComponents\Concerns\HasSettings;
use ChatAgency\BackendComponents\Concerns\HasSlots;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsLivewireComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\PathComponent;
use ChatAgency\BackendComponents\Contracts\SettingsComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

final class MainBackendComponent implements Arrayable, BackendComponent, ContentComponent, Htmlable, LivewireComponent, PathComponent, SettingsComponent, SlotsComponent, ThemeComponent
{
    use HasContent,
        HasPath,
        HasSettings,
        HasSlots,
        IsBackendComponent ,
        IsLivewireComponent,
        IsThemeable;

    public function __construct(
        private string|BackedEnum $name,
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'attributes' => $this->getAttributes(),
            'content' => $this->processContent()->toArray(),
            'theme' => [
                'themes' => $this->getThemes(),
                'path' => $this->themeManager->getDefaultPath(),
                'realPath' => $this->themeManager->getThemePath(),
            ],
            'path' => $this->getComponentPath(),
            'slots' => $this->getSlots(),
            'settings' => $this->getSettings(),
            'isLivewire' => $this->isLivewire(),
            'livewireKey' => $this->getLivewireKey(),
            'livewireParams' => $this->getLivewireParams(),
        ];
    }

    public function toHtml()
    {
        return view(backendComponentNamespace().'_utilities.resolve-component')
            ->with('component', $this)
            ->render();

    }
}
