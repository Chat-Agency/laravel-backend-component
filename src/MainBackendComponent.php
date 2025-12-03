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
     *   manager: class-string<ThemeManager>,
     *   themes: array<string, array<int|string, string>|string>,
     *   path: string,
     *   realPath: string,
     *  },
     *  path: string|null,
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
                'manager' => get_class($this->themeManager),
                'themes' => $this->getThemes(),
                'path' => $this->themeManager->getDefaultPath(),
                'realPath' => $this->themeManager->getThemePath(),
            ],
            'path' => $this->getPathOnly(),
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
        return \view($this->getContext().'_utilities.resolve-components')
            ->with('component', $this)
            ->with('namespace', $this->getContext())
            ->render();

    }
}
