<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

use BackedEnum;
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
        /**
         * head cell number
         */
        'hcell' => [],
        /**
         * body cell coordinate [row,cell]
         * ej: '2,4'
         */
        'bcell' => [],
    ];

    public function __construct(
        private array $head,
        private array $body,
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public static function make(array $head, array $body, ThemeManager $themeManager = new DefaultThemeManager): static
    {
        return new self($head, $body, $themeManager);
    }

    public function setTheme(string $name, array $style): self
    {
        $this->themes[$name] = $style;

        return $this;
    }

    public function setCellTheme(string $name, $coord, array $style): self
    {
        $this->themes[$name][$coord] = $style;

        return $this;
    }

    public function unsetTheme($name, $coord = null): self
    {
        if ($coord) {
            unset($this->themes[$name][$coord]);

            return $this;
        }

        unset($this->themes[$name]);

        return $this;
    }

    public function getComponent(): BackendComponent
    {

        $theme = $this->themes['table'] ?? null;

        return $this->composeComponent(ComponentEnum::TABLE, [
            $this->head(),
            $this->body(),
        ], $theme);
    }

    private function head(): BackendComponent
    {
        $columns = [];

        $theme = $this->themes['th'] ?? null;

        foreach ($this->head as $key => $value) {

            $columns[] = $this->composeComponent(
                ComponentEnum::TH,
                $value,
                $this->themes['hcell'][$key] ?? $theme
            );
        }

        return $this->composeComponent(ComponentEnum::THEAD, [
            $this->composeComponent(ComponentEnum::TR, $columns),
        ]);

    }

    private function body(): BackendComponent
    {
        $rows = [];

        $theme = $this->themes['tr'] ?? null;

        foreach ($this->body as $key => $row) {
            $rows[] = $this->composeComponent(
                ComponentEnum::TR,
                $this->rows($row, $key),
                $theme
            );
        }

        return $this->composeComponent(ComponentEnum::TBODY, $rows);
    }

    private function rows(array $rows, int $rowKey): array
    {
        $cells = [];

        $theme = $this->themes['td'] ?? null;

        foreach ($rows as $key => $value) {

            $cells[] = $this->composeComponent(
                ComponentEnum::TD,
                $value,
                $this->themes['bcell']["{$rowKey},{key}"] ?? $theme
            );
        }

        return $cells;
    }

    public function composeComponent(BackedEnum $name, array|string|BackendComponent $contents, $theme = null): BackendComponent
    {
        $contents = is_array($contents) ? $contents : [$contents];

        $component = (new MainBackendComponent($name, $this->themeManager))
            ->setContents($contents);

        if ($theme) {
            $component->setTheme($theme['name'], $theme['style']);
        }

        return $component;
    }
}
