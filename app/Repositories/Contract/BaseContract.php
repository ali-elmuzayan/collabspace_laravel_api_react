<?php

namespace App\Repositories\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseContract
{
    /**
     * find resource by id
     */
    public function find(int $id);

    /**
     * Find all resources
     */
    public function findAll(): Collection;

    /**
     * Create a new resource
     */
    public function create(array $data): Model;

    /**
     * Update a resource by id
     */
    public function update(int $id, array $data): Model;

    /**
     * Delete a resource by id
     */
    public function delete(int $id): bool;
}
