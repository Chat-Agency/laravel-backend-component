<?php

namespace Factories;

use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;

final class ComponentFactory
{
    
    /**
     * @param array{
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
     *  path: string,
     *  slots: array<int|string, array<string, int|string>|int|string>,
     *  settings: array<string, bool|string>,
     *  isLivewire: bool,
     *  livewireKey: string|null,
     *  livewireParams: array<string, mixed>
     * } $componentArray
     */
    public  static function fromArray(array $componentArray): BackendComponent|CompoundComponent
    {
        return (new static())->resolveComponent($componentArray);
    }

    /**
     * @param array{
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
     *  path: string,
     *  slots: array<int|string, array<string, int|string>|int|string>,
     *  settings: array<string, bool|string>,
     *  isLivewire: bool,
     *  livewireKey: string|null,
     *  livewireParams: array<string, mixed>
     * } $componentArray
     */
    private function resolveComponent(array $componentArray): BackendComponent|CompoundComponent
    {
        $componentClass = $componentArray['component'];

        /** @var CompoundComponent $component */
        $component = new $componentClass($componentArray['name']);

        $component->setAttributes($componentArray['attributes']);

        $component->setContents($this->resolveArrayContents($componentArray['contents']));

        $component->setThemes($componentArray['theme']['themes']);

        if(count($this->resolveSlots($componentArray['slots']))) {
            $component->setSlots($this->resolveSlots($componentArray['slots']));
        }

        if(count($componentArray['settings'])) {
            $component->setSettings($componentArray['settings']);
        }

        $component->setPath($componentArray['path']);

        if($componentArray['isLivewire']) {
            $component->setLivewire($componentArray['isLivewire']);

            if ($componentArray['livewireKey'] !== null) {
                $component->setLivewireKey($componentArray['livewireKey']);
            }
            
            $component->setLivewireParams($componentArray['livewireParams']);
        }
        
        $themeManager = $this->resolveThemeManager($componentArray['theme']['manager']); 
        $themeManager->setDefaultPath($componentArray['theme']['path']);
        $component->setThemeManager($themeManager);

        return $component;
    }

    /**
     * @param  array<string, array<string, int|mixed>|int|string>  $contentsArray
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

    /**
     * @param array<string, array<string, int|mixed>> $slotsArray
     * @return array<string|int, string|int|CompoundComponent|BackendComponent>
     */
    public function resolveSlots(array $slotsArray): array
    {
        $slots = [];

        foreach ($slotsArray as $name => $slot) {
            $slots[$name] = $this->resolveComponent($slot);
        }

        return $slots;
    }

    /**
     * @param  class-string<ThemeManager>  $managerClass
     */
    public function resolveThemeManager(string $managerClass): ThemeManager
    {
        return new $managerClass;
    }
}
