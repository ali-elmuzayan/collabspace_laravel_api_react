<?php

namespace App\Repositories;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Contract\BaseContract;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository extends BaseRepository implements BaseContract
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Project $project)
    {
        parent::__construct($this->project);
    }

    /**
     * Get active projects
     */
    public function getActiveProjects(): Collection
    {
        return $this->project
            ->where('status', ProjectStatus::InProgress)
            ->get();
    }
}
