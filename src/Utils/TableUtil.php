<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\ContentComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

final class TableUtil
{
    /**
     * @var array<string, array<string, list<string>|string>>
     */
    private array $themes = [
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
    ];

    /**
     * @param  array<string|int, string|CellBag|array<string|int, mixed>>  $head
     * @param  array<string|int, array<string|int, string|CellBag|array<string|int, mixed>>>  $body
     */
    public function __construct(
        private array $head,
        private array $body,
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    /**
     * @param  array<string|int, string|CellBag|array<string|int, mixed>>  $head
     * @param  array<string|int, array<string|int, string|CellBag|array<string|int, mixed>>>  $body
     */
    public static function make(array $head, array $body, ThemeManager $themeManager = new DefaultThemeManager): static
    {
        return new self($head, $body, $themeManager);
    }

    /**
     * @param  array<string, string|array<string|int, string>>  $style
     */
    public function setTheme(string $name, array $style): self
    {
        $theme = $this->themes[$name];
        $this->themes[$name] = array_merge($theme, $style);

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

        foreach ($this->head as $value) {

            $columns[] = $this->composeComponent(
                name: ComponentEnum::TH,
                contents: $this->resolveContent($value),
                theme: $this->resolveTheme($themeTh, $value),
                attributes: $this->resolveAttributes($value),
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

    /**
     * @param  array<int, string|CellBag|array<string|int, mixed>>  $rows
     * @return array<string|int, int|string|BackendComponent>
     */
    private function rows(array $rows, int $rowKey): array
    {
        $cells = [];

        $themeTd = $this->themes['td'] ?? null;
        $key = 0;

        $rowKey = $rowKey + 1;
        foreach ($rows as $value) {

            $cells[] = $this->composeComponent(
                ComponentEnum::TD,
                contents: $this->resolveContent($value),
                theme: $this->resolveTheme($themeTd, $value),
                attributes: $this->resolveAttributes($value),
            );

            $key++;
        }

        return $cells;
    }

    /**
     * @param  int|string|BackendComponent|array<string|int, int|string|BackendComponent>  $contents
     * @param  array<string, string|array<string|int, string>>|null  $theme
     * @param  array<string, string|null>|null  $attributes
     */
    public function composeComponent(BackedEnum $name, int|array|string|BackendComponent $contents, ?array $theme = null, ?array $attributes = null): BackendComponent
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

    /**
     * @param  string|CellBag|BackendComponent|array<string|int, string|CellBag|array<string|int, mixed>>  $content
     */
    private function resolveContent(array|string|CellBag|BackendComponent $content): string|BackendComponent|ContentComponent|null
    {
        $content = is_array($content) ? ($content['content'] ?? null) : $content;

        $content = $content instanceof CellBag && $content->content ? $content->content : $content;

        return $content;
    }

    /**
     * @param  string|CellBag|BackendComponent|array<string|int, string|CellBag|array<string|int, mixed>>  $content
     * @param  array<string, string|array<string|int, string>>  $theme
     * @return array<string, string|array<string|int, string>>
     */
    private function resolveTheme(array $theme, array|string|CellBag|BackendComponent $content): array
    {
        $theme = is_array($content) ? ($content['theme'] ?? $theme) : $theme;

        $theme = $content instanceof CellBag && $content->theme ? $content->theme : $theme;

        return $theme;
    }

    /**
     * @param  string|CellBag|BackendComponent|array<string|int, string|CellBag|array<string|int, mixed>>  $content
     * @return array<string, string|null>
     */
    private function resolveAttributes(array|string|CellBag|BackendComponent $content): array
    {
        $attributes = is_array($content) ? ($content['attributes'] ?? []) : [];

        $attributes = $content instanceof CellBag && $content->attributes ? $content->attributes : $attributes;

        return $attributes;

    }
}
