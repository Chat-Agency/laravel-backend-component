<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\PathComponent;
use ChatAgency\BackendComponents\Contracts\SlotsComponent;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use ChatAgency\BackendComponents\Contracts\SettingsComponent;

final class TableUtil
{
    private $themes = [
        'table' => [
            'table' => 'table',
        ],
        'th' => [
            'table' => [
                'th',
                'th-dark',
            ],
        ],
        'td' => [
            'table' => [
                'td',
                'td-dark',
            ],
        ],
        'cells' => [
            /**
             * head cell number
             */
            'hcell' => [],
            /**
             * body cell coordinate [row,cell]
             * ej: '2,4'
             */
            'bcell' => [],
        ],
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
        $theme = $this->themes[$name];
        $this->themes[$name] = array_merge($theme, $style);

        return $this;
    }

    public function setCellTheme(string $name, $coord, array $style): self
    {
        $theme = $this->themes['cells'][$name][$coord] ?? [];
        $this->themes['cells'][$name][$coord] = array_merge($theme, $style);

        return $this;
    }

    public function getComponent(): BackendComponent
    {

        $theme = $this->themes['table'] ?? null;

        $contents = [];

        if (count($this->head)) {
            $contents[] = $this->head();
        }

        $contents[] = $this->body();

        return $this->composeComponent(ComponentEnum::TABLE, $contents, $theme);
    }

    private function head(): BackendComponent
    {
        $columns = [];

        $themeTh = $this->themes['th'] ?? null;

        foreach ($this->head as $key => $value) {

            $theme = $this->themes['cells']['hcell'][$key] ?? $themeTh;

            $content = is_array($value) ? ($value['content'] ?? null) : $value;
            $attributes = is_array($value) ? ($value['attributes'] ?? []) : [];
            $theme = is_array($value) ? ($value['theme'] ?? $theme) : $theme;

            $columns[] = $this->composeComponent(
                ComponentEnum::TH,
                $content,
                $theme,
                $attributes
            );
        }

        return $this->composeComponent(ComponentEnum::THEAD, [
            $this->composeComponent(ComponentEnum::TR, $columns),
        ]);

    }

    private function body(): Arrayable|BackendComponent|ContentComponent|Htmlable|LivewireComponent|PathComponent|SettingsComponent|SlotsComponent|ThemeComponent
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

        $themeTd = $this->themes['td'] ?? null;

        $rowKey = $rowKey + 1;
        foreach ($rows as $key => $value) {

            $cellKey = $key + 1;

            $theme = $this->themes['cells']['bcell']["{$rowKey},{$cellKey}"] ?? $themeTd;

            $content = is_array($value) ? ($value['content'] ?? null) : $value;
            $attributes = is_array($value) ? ($value['attributes'] ?? []) : [];
            $theme = is_array($value) ? ($value['theme'] ?? $theme) : $theme;

            $cells[] = $this->composeComponent(
                ComponentEnum::TD,
                $content,
                $theme,
                $attributes
            );
        }

        return $cells;
    }

    public function composeComponent(BackedEnum $name, array|string|BackendComponent $contents, ?array $theme = null, ?array $attributes = null): BackendComponent
    {
        $contents = is_array($contents) ? $contents : [$contents];

        $component = (new MainBackendComponent($name, $this->themeManager))
            ->setContents($contents);

        if ($theme) {
            $component->setThemes($theme);
        }

        if ($attributes) {
            $component->setAttributes($attributes);
        }

        return $component;
    }
}
