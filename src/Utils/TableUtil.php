<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

final class TableUtil
{
    private $themes = [
        'table' => [
            'name' => 'table',
            'style' => 'table',
        ],
        'th' => [
            'name' => 'table',
            'style' => 'th',
        ],
        'td' => [
            'name' => 'table',
            'style' => 'td',
        ],
    ];

    public function __construct(
        private array $head,
        private array $body,
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public static function make(array $head, array $body): static
    {
        return new self($head, $body);
    }

    public function getComponent(): BackendComponent
    {

        $theme = $this->themes['table'] ?? null;

        $component = (new MainBackendComponent(ComponentEnum::TABLE, $this->themeManager))
            ->setContents([
                $this->head(),
                $this->body(),
            ]);

        if ($theme) {
            $component->setTheme($theme['name'], $theme['style']);
        }

        return $component;
    }

    public function setTheme($name, $style): self
    {
        $this->themes[$name] = $style ?? null;

        return $this;
    }

    private function head(): BackendComponent
    {
        $columns = [];

        $theme = $this->themes['th'] ?? null;

        foreach ($this->head as $value) {
            $component = (new MainBackendComponent(ComponentEnum::TH, $this->themeManager))
                ->setContent($value);

            if ($theme) {
                $component->setTheme($theme['name'], $theme['style']);
            }

            $columns[] = $component;
        }

        return (new MainBackendComponent(ComponentEnum::THEAD, $this->themeManager))
            ->setContents([
                (new MainBackendComponent(ComponentEnum::TR, $this->themeManager))
                    ->setContents($columns),
            ]);

    }

    private function body(): BackendComponent
    {
        $rows = [];

        $theme = $this->themes['tr'] ?? null;

        foreach ($this->body as $row) {
            $component = (new MainBackendComponent(ComponentEnum::TR, $this->themeManager))
                ->setContents($this->rows($row));

            if ($theme) {
                $component->setTheme($theme['name'], $theme['style']);
            }

            $rows[] = $component;
        }

        // dd( $rows );

        return (new MainBackendComponent(ComponentEnum::TBODY, $this->themeManager))
            ->setContents($rows);
    }

    private function rows(array $rows): array
    {
        $cells = [];

        $theme = $this->themes['td'] ?? null;

        foreach ($rows as $value) {
            $component = (new MainBackendComponent(ComponentEnum::TD, $this->themeManager))
                ->setContents($value);

            if ($theme) {
                $component->setTheme($theme['name'], $theme['style']);
            }

            $cells[] = $component;
        }

        return $cells;
    }
}
