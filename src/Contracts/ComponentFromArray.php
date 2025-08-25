<?php

declare(strict_types=1);

namespace Contracts;

interface ComponentFromArray
{
    public function fromArray(): static;
}
