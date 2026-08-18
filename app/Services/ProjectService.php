<?php

namespace App\Services;

use App\Enums\ProjectMemberRole;
use App\Events\ProjectCreated;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Traits\Concerns\Relationable;

class ProjectService
{
    use Relationable;

    /**
     * Get all projects
     */
    public function getAllProjects(User $user)
    {
        $query = Project::query()
            ->with(['teams:id,name'])
            ->withFilesCount();

        if ($user->isAdmin()) {
            return $query->latest()->get();
        }

        return $query
            ->where(function ($query) use ($user): void {
                $query
                    ->where('created_by', $user->id)
                    ->orWhereHas('members', fn ($memberQuery) => $memberQuery->whereKey($user->id));
            })
            ->latest()
            ->get();
    }

    /**
     * Show Project
     */
    public function showProject(User $user, Project $project): Project
    {
        $relations = ['tasks', 'files'];

        if ($user->isAdmin()) {
            $relations[] = 'members';
        }

        return $project->load($relations);
    }

    /**
     * Create the Project
     */
    public function createProject(User $user, array $data): Project
    {
        $project = Project::query()->create([
            ...$data,
            'created_by' => $user->id,
        ]);

        $project->members()->attach($user->id, [
            'role' => ProjectMemberRole::Admin->value,
        ]);

        ProjectCreated::dispatch($project);

        return $project->load(['teams:id,name', 'members']);
    }

    /**
     * Update the Project
     */
    public function updateProject(User $user, Project $project, array $data): Project
    {
        $project->update($data);

        return $project->fresh(['teams:id,name', 'members']);
    }

    /**
     * assign team to the project
     */
    public function assignTeamToProject(Project $project, Team|array $teams): Project
    {
        $teamIds = collect(is_array($teams) ? $teams : [$teams])
            ->map(fn (Team|int $team) => $team instanceof Team ? $team->id : $team);

        $project->teams()->syncWithoutDetaching($teamIds);

        return $project->load('teams');
    }

    /**
     * Delete the Projects
     */
    public function deleteProject(Project $project): bool
    {
        return (bool) $project->delete();
    }
}
