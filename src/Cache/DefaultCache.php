<?php

namespace ChatAgency\BackendComponents\Cache;

class DefaultCache
{
    protected $values = [];

    public function get(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }

    public function set($key, $value): void
    {
        $this->values[$key] = $value;
    }

    public function has($key): bool
    {
        return isset($this->values[$key]);
    }
}
