<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components\Individual;

use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Components\DefaultContentsComponent;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class DivComponent implements Arrayable, BackendComponent, Htmlable, ThemeComponent
{
    use IsBackendComponent,
        IsThemeable;

    private array $content = [];

    public function __construct(
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

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

    public function getContent($key = null): string|Arrayable|BackendComponent|Htmlable|ThemeComponent|null
    {
        return $this->content[$key] ?? null;
    }

    public function getContents(): array
    {
        return $this->content;
    }

    public function setContent(string|BackendComponent $content, $key = null): static
    {
        if ($key) {
            $this->content[$key] = $content;

            return $this;
        }

        $this->content[] = $content;

        return $this;
    }

    public function setContents(array $contents): static
    {
        foreach ($contents as $key => $content) {
            $this->setContent($content, $key);
        }

        return $this;
    }

    public function processContent(): ContentsComponent
    {
        return new DefaultContentsComponent($this->getContents());
    }
}
