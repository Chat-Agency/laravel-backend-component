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

    public function setTheme($name, $style): self
    {
        $this->themes[$name] = $style ?? null;

        return $this;
    }

    public function unsetTheme($name): self
    {
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

        foreach ($this->head as $value) {
            $columns[] = $this->composeComponent(ComponentEnum::TH, $value, $theme);
        }

        return $this->composeComponent(ComponentEnum::THEAD, [
            $this->composeComponent(ComponentEnum::TR, $columns),
        ]);

    }

    private function body(): BackendComponent
    {
        $rows = [];

        $theme = $this->themes['tr'] ?? null;

        foreach ($this->body as $row) {
            $rows[] = $this->composeComponent(ComponentEnum::TR, $this->rows($row), $theme);
        }

        return $this->composeComponent(ComponentEnum::TBODY, $rows);
    }

    private function rows(array $rows): array
    {
        $cells = [];

        $theme = $this->themes['td'] ?? null;

        foreach ($rows as $value) {
            $cells[] = $this->composeComponent(ComponentEnum::TD, $value, $theme);
        }

        return $cells;
    }

    public function composeComponent(BackedEnum $name, array|string $contents, $theme = null): BackendComponent
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
