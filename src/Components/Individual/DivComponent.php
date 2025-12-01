<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components\Individual;

use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Concerns\HasContent;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;
use ChatAgency\BackendComponents\Contracts\IndividualComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class DivComponent implements BackendComponent, ContentsComponent, Htmlable, IndividualComponent, ThemeComponent
{
    use HasContent,
        IsBackendComponent,
        IsThemeable;

    public function __construct(
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    /**
     * @return array<string, array<string, array<string, array<int|string, string>|int|string>|int|string|null>|string>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'component' => self::class,
            'attributes' => $this->getAttributes(),
            'contents' => $this->processContent()->toArray(),
            'theme' => [
                'manager' => get_class($this->themeManager),
                'themes' => $this->getThemes(),
                'path' => $this->themeManager->getDefaultPath(),
                'realPath' => $this->themeManager->getThemePath(),
            ],
        ];
    }

    public function toHtml()
    {
        /**
         * PHPStan bug
         * https://github.com/larastan/larastan/issues/2213
         *
         * @phpstan-ignore argument.type
         */
        return view($this->getComponentPath())
            ->with('attrs', $this->getAttributeBag())
            ->render();
    }

    public function getAttributeBag(): AttributeBag
    {
        return new DefaultAttributeBag(
            attributes: $this->getAttributes(),
            content: $this->processContent(),
            themes: $this->compileTheme(),
        );
    }

    public function getName(): string
    {
        return ComponentEnum::DIV->value;
    }

    public function getComponentPath(): string
    {
        return backendComponentNamespace()
            .$this->getPathOnly();
    }

    public function getPathOnly(): string
    {
        return 'components.'
            .$this->getName();
    }
}
