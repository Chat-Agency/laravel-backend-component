<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

use ChatAgency\BackendComponents\Contracts\BackendComponent;

final readonly class CellBag
{
    /**
     * @param  array<string|int, string|null>|null  $attributes
     * @param  array<string, string|array<string|int, string>>|null  $theme
     */
    public function __construct(
        public int|string|BackendComponent $content,
        public ?array $theme = null,
        public ?array $attributes = null
    ) {}
}
