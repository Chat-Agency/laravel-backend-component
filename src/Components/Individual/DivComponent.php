<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components\Individual;

use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Concerns\HasContent;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class DivComponent implements Arrayable, BackendComponent, ContentComponent, Htmlable, ThemeComponent
{
    use HasContent,
        IsBackendComponent,
        IsThemeable;

    public function __construct(
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function toArray(): array
    {
        return [
            'attributes' => $this->getAttributes(),
            'content' => $this->processContent(),
            'themes' => $this->compileTheme(),
        ];
    }

    public function getAttributeBag(): AttributeBag
    {
        return new DefaultAttributeBag(
            $this->getAttributes(),
            $this->processContent(),
            $this->compileTheme(),
        );
    }

    public function componentPath()
    {
        return backendComponentNamespace()
            .'components.'
            .ComponentEnum::DIV->value;
    }

    public function toHtml()
    {
        return view($this->componentPath())
            ->with('attrs', new DefaultAttributeBag(
                ...$this->toArray()
            ))
            ->render();
    }
}
