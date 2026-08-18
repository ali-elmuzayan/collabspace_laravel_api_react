<?php

namespace App\Traits\Concerns;

trait Relationable
{
    public function getValidRelations(array $relations, array|string $validRelations): array
    {

        if (is_string($validRelations)) {
            $validRelations = explode(',', $validRelations);
        }

        return array_intersect($relations, $validRelations) ?? [];
    }
}
