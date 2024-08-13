<?php

namespace ChatAgency\BackendComponents\Themes;

use ChatAgency\BackendComponents\Contracts\ThemeBag;

class DefaultThemeBag implements ThemeBag
{
    public function __construct(
        protected array $styles
    ) {}

    public static function make(array $styles): self
    {
        return new static($styles);
    }

    public function getStyles(): array
    {
        return $this->styles;
    }
}
