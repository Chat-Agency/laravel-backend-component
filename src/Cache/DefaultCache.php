<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Cache;

class DefaultCache
{
    protected $values = [];

    public function get(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }

    public function set(string $key, $value): void
    {
        $this->values[$key] = $value;
    }

    public function has($key): bool
    {
        return isset($this->values[$key]);
    }

    public function delete(string $key): void
    {
        if ($this->has($key)) {
            unset($this->values[$key]);
        }
    }
}
