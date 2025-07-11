<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

use BackedEnum;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

use function ChatAgency\BackendComponents\isCellBag;
use function ChatAgency\BackendComponents\isComponent;

final class TableUtil
{
    /**
     * @var array<string, string|array<string|int, string>>
     */
    private array $tableThemes = [
        'table' => 'table',
    ];

    /**
     * @var array<string, string|array<string|int, string>>
     */
    private array $thThemes = [
        'table' => [
            'th',
            'th-dark',
        ],
    ];

    /**
     * @var array<string, string|array<string|int, string>>
     */
    private array $trThemes = [
        'table' => [],
    ];

    /**
     * @var array<string, string|array<string|int, string>>
     */
    private array $tdThemes = [
        'table' => [
            'td',
            'td-dark',
        ],
    ];

    /**
     * @param  array<string|int, string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, int|string|null>
     * }>  $head
     * @param  array<string|int, array<string|int, string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, string|int|null>
     * }>>  $body
     */
    public function __construct(
        private array $head,
        private array $body,
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    /**
     * @param  array<string|int, string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, string|int|null>
     * }>  $head
     * @param  array<string|int, array<string|int, string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, string|int|null>
     * }>>  $body
     */
    public static function make(array $head, array $body, ThemeManager $themeManager = new DefaultThemeManager): static
    {
        return new self($head, $body, $themeManager);
    }

    /**
     * @param  array<string, string|array<string|int, string>>  $themes
     */
    public function setTableThemes(array $themes): static
    {
        $this->tableThemes = $themes;

        return $this;
    }

    /**
     * @param  array<string, string|array<string|int, string>>  $themes
     */
    public function setThThemes(array $themes): static
    {
        $this->thThemes = $themes;

        return $this;
    }

    /**
     * @param  array<string, string|array<string|int, string>>  $themes
     */
    public function setTrThemes(array $themes): static
    {
        $this->trThemes = $themes;

        return $this;
    }

    /**
     * @param  array<string, string|array<string|int, string>>  $themes
     */
    public function setTdThemes(array $themes): static
    {
        $this->tdThemes = $themes;

        return $this;
    }

    public function getComponent(): CompoundComponent
    {

        $theme = $this->tableThemes;

        $contents = [];

        if (count($this->head)) {
            $contents[] = $this->head();
        }

        $contents[] = $this->body();

        return $this->composeComponent(ComponentEnum::TABLE, $contents, $theme);
    }

    private function head(): CompoundComponent
    {
        $columns = [];

        $themeTh = $this->thThemes;

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

    private function body(): CompoundComponent
    {
        $rows = [];

        $theme = $this->trThemes;

        foreach ($this->body as $row) {
            $rows[] = $this->composeComponent(
                ComponentEnum::TR,
                $this->rows($row),
                $theme
            );
        }

        return $this->composeComponent(ComponentEnum::TBODY, $rows);
    }

    /**
     * @param  array<string|int, string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, string|int|null>
     * }>  $rows
     * @return array<int, CompoundComponent>
     */
    private function rows(array $rows): array
    {
        $cells = [];

        $themeTd = $this->tdThemes;

        foreach ($rows as $value) {

            $cells[] = $this->composeComponent(
                ComponentEnum::TD,
                contents: $this->resolveContent($value),
                theme: $this->resolveTheme($themeTd, $value),
                attributes: $this->resolveAttributes($value),
            );

        }

        return $cells;
    }

    /**
     * @param string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, string|int|null>
     * } $content
     */
    private function resolveContent(array|string|CellBag|CompoundComponent $content): string|int|CompoundComponent
    {
        if (isCellBag($content)) {
            return $content->content;
        }

        if (is_array($content)) {
            return $content['content'];
        }

        if (isComponent($content)) {
            return $content;
        }

        return $content;

    }

    /**
     * @param string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, string|int|null>
     * } $content
     * @param  array<string, string|array<string|int, string>>  $theme
     * @return array<string, string|array<string|int, string>>
     */
    private function resolveTheme(array $theme, array|string|CellBag|CompoundComponent $content): array
    {
        if (isCellBag($content) && $content->theme) {
            return $content->theme;
        }

        if (is_array($content) && isset($content['theme'])) {
            return $content['theme'];
        }

        return $theme;

    }

    /**
     * @param string|CompoundComponent|CellBag|array{
     *   content: string|int|CompoundComponent,
     *   theme?: array<string, string|array<string|int, string>>,
     *   attributes?: array<string, string|int|null>
     * } $content
     * @return array<string, int|string|null>
     */
    private function resolveAttributes(array|string|CellBag|CompoundComponent $content): array
    {
        if (isCellBag($content) && $content->attributes) {
            return $content->attributes;
        }

        if (is_array($content) && isset($content['attributes'])) {
            return $content['attributes'];
        }

        return [];

    }

    /**
     * @param  int|string|CompoundComponent|array<string|int, int|string|CompoundComponent>  $contents
     * @param  array<string, string|array<string|int, string>>|null  $theme
     * @param  array<string, int|string|null>  $attributes
     */
    public function composeComponent(BackedEnum $name, int|array|string|CompoundComponent $contents, ?array $theme = null, ?array $attributes = null): CompoundComponent
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
