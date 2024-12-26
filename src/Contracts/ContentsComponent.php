<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface ContentsComponent
{
    public function toHtml();

    public function toArray(): array;
}
