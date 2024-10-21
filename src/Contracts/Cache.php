<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Contracts;

interface Cache
{
    public function get(string $key): mixed;

    public function set(string $key, $value): void;

    public function has($key): bool;

    public function delete(string $key): void;
}
