<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents;

use BackedEnum;
use ChatAgency\BackendComponents\Components\DefaultAttributeBag;
use ChatAgency\BackendComponents\Concerns\HasContent;
use ChatAgency\BackendComponents\Concerns\HasPath;
use ChatAgency\BackendComponents\Concerns\HasSettings;
use ChatAgency\BackendComponents\Concerns\HasSlots;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Concerns\IsLivewireComponent;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\AttributeBag;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Illuminate\Contracts\Support\Htmlable;

final class MainBackendComponent implements CompoundComponent, Htmlable
{
    use HasContent,
        HasPath,
        HasSettings,
        HasSlots,
        IsBackendComponent,
        IsLivewireComponent,
        IsThemeable;

    public function __construct(
        private string|BackedEnum $name,
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function getAttributeBag(): AttributeBag
    {
        return new DefaultAttributeBag(
            $this->getAttributes(),
            $this->processContent(),
            $this->compileTheme(),
            $this->getComponentPath(),
            $this->getSlots(),
            $this->getSettings(),
            $this->isLivewire(),
            $this->getLivewireKey(),
            $this->getLivewireParams(),
        );
    }

    /**
     * @return array{
     *  name:  int|string,
     *  component: class-string<BackendComponent|CompoundComponent>,
     *  attributes: array<string, int|string|null>,
     *  contents: array<string,array<string, int|string>|int|string>,
     *  theme: array{
     *    themes: array<string, array<int|string, string>|string>,
     *    path: string,
     *    realPath: string,
     *  },
     *  path: string,
     *  slots: array<string, array<string, int|string>|int|string>,
     *  settings: array<string, bool|string>,
     *  isLivewire: bool,
     *  livewireKey: string|null,
     *  livewireParams: array<string, mixed>
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'component' => self::class,
            'attributes' => $this->getAttributes(),
            'contents' => $this->processContent()->toArray(),
            'theme' => [
                'themes' => $this->getThemes(),
                'path' => $this->themeManager->getDefaultPath(),
                'realPath' => $this->themeManager->getThemePath(),
            ],
            'path' => $this->getComponentPath(),
            'slots' => $this->processSlots()->toArray(),
            'settings' => $this->getSettings(),
            'isLivewire' => $this->isLivewire(),
            'livewireKey' => $this->getLivewireKey(),
            'livewireParams' => $this->getLivewireParams(),
        ];
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        /**
         * PHPStan bug
         * https://github.com/larastan/larastan/issues/2213
         *
         * @phpstan-ignore argument.type
         */
        return \view(backendComponentNamespace().'_utilities.resolve-component')
            ->with('component', $this)
            ->render();

    }

    public function fromArray(): BackendComponent|CompoundComponent
    {
        return $this->resolveComponent($this->toArray());
    }

    /**
     * @param  array<string, array<string, mixed>|bool|int|string|null>  $component
     */
    private function resolveComponent(array $component): BackendComponent|CompoundComponent
    {
        $componentArray = $this->toArray();

        $componentClass = $componentArray['component'];

        /** @var CompoundComponent $component */
        $component = new $componentClass($componentArray['name']);

        $component->setAttributes($componentArray['attributes']);

        $component->setContents(
            $this->resolveArrayContents($componentArray['contents'])
        );

        return $component;
    }

    /**
     * @param  array<string,array<string, int|string>|int|string>  $contentsArray
     * @return array<string|int, string|int|CompoundComponent|BackendComponent>
     */
    private function resolveArrayContents(array $contentsArray): array
    {
        $contents = [];

        foreach ($contentsArray as $name => $content) {
            $contentArray[$name] = is_array($content)
                ? $this->resolveComponent($content)
                : $content;
        }

        return $contents;
    }
}
