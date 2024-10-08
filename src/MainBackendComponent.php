<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents;

use BackedEnum;
use ChatAgency\BackendComponents\Concerns\HasChildren;
use ChatAgency\BackendComponents\Concerns\HasContent;
use ChatAgency\BackendComponents\Concerns\HasExtraParams;
use ChatAgency\BackendComponents\Concerns\HasSlots;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsLivewireComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ChildrenComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\ExtraParamsComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

final class MainBackendComponent implements Arrayable, BackendComponent, ChildrenComponent, ContentComponent, ExtraParamsComponent, Htmlable, LivewireComponent, SlotsComponent, ThemeComponent
{
    use HasChildren,
        HasContent,
        HasExtraParams,
        HasSlots,
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
            'children' => $this->getChildren(),
            'themes' => $this->compileTheme(),
            'slots' => $this->getSlots(),
            'extra' => $this->getExtras(),
            'isLivewire' => $this->isLivewire(),
            'livewireKey' => $this->getLivewireKey(),
            'livewireParams' => $this->getLivewireParams(),
        ];
    }
}
