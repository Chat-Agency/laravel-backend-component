<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

use ChatAgency\BackendComponents\Contracts\BackendComponent;

final readonly class CellBag
{
    /**
     * @param  array<string,int>  $attributes
     */
    public function __construct(
        public string|BackendComponent $content,
        public ?array $theme = null,
        public ?array $attributes = null
    ) {}
}
