<?php

namespace App\Repository\Eloquent;

use App\Repository\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T
 * @implements BaseRepositoryInterface<T>
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /** @var Model&Builder */
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function fetchById(int $id): ?Model
    {
        return $this->model->find($id);
    }
}
