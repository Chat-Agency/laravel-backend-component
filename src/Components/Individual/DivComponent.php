<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components\Individual;

use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Components\DefaultContentsComponent;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;
use function ChatAgency\BackendComponents\isBackedEnum;

class DivComponent implements BackendComponent, Htmlable, ThemeComponent
{
    use IsBackendComponent,
        IsThemeable;

    /**
     * @var array<string|int, string|int|CompoundComponent>
     */
    private array $content = [];

    public function __construct(
        private string|ComponentEnum $name = ComponentEnum::DIV,
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

    public function getName(): string
    {
        $name = $this->name;

        if (isBackedEnum($name)) {
            return $name->value;
        }

        return $name;
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

    public function getContent(string|int $key): CompoundComponent|int|string|null
    {
        return $this->content[$key] ?? null;
    }

    /**
     * @return array<string|int, string|int|CompoundComponent>
     */
    public function getContents(): array
    {
        return $this->content;
    }

    public function setContent(int|string|CompoundComponent $content, string|int|null $key = null): static
    {
        if ($key) {
            $this->content[$key] = $content;

            return $this;
        }

        array_push($this->content, $content);

        return $this;
    }

    /**
     * @param  array<string|int, string|int|CompoundComponent>  $contents
     */
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

    public function getAttributeBag(): AttributeBag
    {
        return new DefaultAttributeBag(
            attributes: $this->getAttributes(),
            content: $this->processContent(),
            themes: $this->compileTheme(),
        );
    }
}
