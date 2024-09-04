<?php

namespace ChatAgency\BackendComponents;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;
use ChatAgency\BackendComponents\Concerns\HasSlots;
use ChatAgency\BackendComponents\Concerns\HasContent;
use ChatAgency\BackendComponents\Concerns\IsThemeable ;
use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Concerns\HasExtraParams;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Concerns\HasSubComponents;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Concerns\IsLivewireComponent;
use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Contracts\ExtraParamsComponent;
use ChatAgency\BackendComponents\Contracts\SubComponentsComponent;

final class MainBackendComponent implements Arrayable, Htmlable, BackendComponent, ContentComponent, SubComponentsComponent, ThemeComponent, SlotsComponent, LivewireComponent, ExtraParamsComponent
{
    use IsBackendComponent,
        HasContent,
        HasSubComponents,
        IsThemeable ,
        HasSlots,
        IsLivewireComponent,
        HasExtraParams;
    
    public function __construct(
        protected string | BackedEnum $name,
        protected ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function getAttributeBag() : AttributeBag
    {
        $attrs = $this->toArray();
        unset($attrs['name']);
        return new DefaultAttributeBag(...$attrs); 
    }

    public function toArray() : array
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
