<?php

namespace App\Services;

use App\Interfaces\CacheInterface;
use Closure;

class CacheService implements CacheInterface
{
    /** @var CacheInterface $cache */
    private mixed $cache;

    public function __construct()
    {
        $this->cache = app('cache');
    }

    public function rememberForever(string $key, Closure $callback): mixed
    {
        return $this->cache->rememberForever($key, $callback);
    }

    public function forget(string $key): bool
    {
        return $this->cache->forget($key);
    }
}
