<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents;

use BackedEnum;
use ChatAgency\BackendComponents\Concerns\HasContent;
use ChatAgency\BackendComponents\Concerns\HasExtraParams;
use ChatAgency\BackendComponents\Concerns\HasSlots;
use ChatAgency\BackendComponents\Concerns\HasSubComponents;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsLivewireComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\ExtraParamsComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\SubComponentsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

final class MainBackendComponent implements Arrayable, BackendComponent, ContentComponent, ExtraParamsComponent, Htmlable, LivewireComponent, SlotsComponent, SubComponentsComponent, ThemeComponent
{
    use HasContent,
        HasExtraParams,
        HasSlots,
        HasSubComponents,
        IsBackendComponent ,
        IsLivewireComponent,
        IsThemeable;

    public function __construct(
        protected string|BackedEnum $name,
        protected ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'content' => $this->getContent(),
            'path' => $this->getComponentPath(),
            'attributes' => $this->getAttributes(),
            'subComponents' => $this->getSubComponents(),
            'themes' => $this->compileTheme(),
            'slots' => $this->getSlots(),
            'extra' => $this->getExtras(),
            'isLivewire' => $this->isLivewire(),
            'livewireKey' => $this->getLivewireKey(),
            'livewireParams' => $this->getLivewireParams(),
        ];
    }
}
