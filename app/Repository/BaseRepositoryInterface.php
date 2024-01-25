<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
interface BaseRepositoryInterface
{
    /**
     * @return T|null
     */
    public function fetchById(int $id): ?Model;
}
