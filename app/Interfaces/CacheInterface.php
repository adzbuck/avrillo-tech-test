<?php

namespace App\Interfaces;

use Closure;

interface CacheInterface
{
    public function rememberForever(string $key, Closure $callback): mixed;
    public function forget(string $key): bool;

}
