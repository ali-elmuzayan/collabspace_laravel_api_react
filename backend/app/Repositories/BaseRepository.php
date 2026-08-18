<?php

namespace App\Repositories;

use App\Repositories\Contract\BaseContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseContract
{
    public function __construct(protected Model $model) {}

    /**
     * Find a resource by id
     */
    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find all resources
     */
    public function findAll(): Collection
    {
        return $this->model->get();
    }

    /**
     * Create a new resource
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a resource by id
     */
    public function update(int $id, array $data): Model
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * Delete a resource by id
     */
    public function delete(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }
}
