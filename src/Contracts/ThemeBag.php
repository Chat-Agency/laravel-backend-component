<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ThemeBag
{
    public function getStyles(): array;
}
