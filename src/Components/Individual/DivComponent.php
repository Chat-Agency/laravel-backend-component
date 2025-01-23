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

    public function getContent($key = null): string|Arrayable|BackendComponent|ContentComponent|Htmlable|ThemeComponent|null
    {
        return $this->content[$key] ?? null;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'attributes' => $this->getAttributes(),
            'content' => $this->processContent()->toArray(),
            'themes' => $this->compileTheme(),
            'path' => $this->getComponentPath(),
            'themeManagerPath' => $this->themeManager->getDefaultPath(),
            'themeManagerRealPath' => $this->themeManager->getThemePath(),
        ];
    }

    public function getName(): string
    {
        return ComponentEnum::DIV->value;
    }

    public function getAttributeBag(): AttributeBag
    {
        return new DefaultAttributeBag(
            $this->getAttributes(),
            $this->processContent(),
            $this->compileTheme(),
        );
    }

    public function getComponentPath()
    {
        return backendComponentNamespace()
            .'components.'
            .$this->getName();
    }

    public function toHtml()
    {
        return view($this->getComponentPath())
            ->with('attrs', new DefaultAttributeBag(
                $this->getAttributes(),
                $this->processContent(),
                $this->compileTheme(),
            ))
            ->render();
    }
}
