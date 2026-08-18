<?php

namespace App\Policies;

use App\Enums\ProjectMemberRole;
use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return $this->canAccess($user, $project);
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Project $project): bool
    {
        return $this->isGlobalAdminOrCreator($user, $project)
            || $this->hasMemberRole($user, $project, [
                ProjectMemberRole::Admin,
                ProjectMemberRole::Editor,
            ]);
    }

    public function delete(User $user, Project $project): bool
    {
        return $this->isGlobalAdminOrCreator($user, $project)
            || $this->hasMemberRole($user, $project, [ProjectMemberRole::Admin]);
    }

    public function assignTeam(User $user, Project $project): bool
    {
        return $this->isGlobalAdminOrCreator($user, $project)
            || $this->hasMemberRole($user, $project, [ProjectMemberRole::Admin]);
    }

    private function canAccess(User $user, Project $project): bool
    {
        if ($this->isGlobalAdminOrCreator($user, $project)) {
            return true;
        }

        return $project->members()->whereKey($user->id)->exists();
    }

    private function isGlobalAdminOrCreator(User $user, Project $project): bool
    {
        return $user->isAdmin() || $project->created_by === $user->id;
    }

    /**
     * @param  array<int, ProjectMemberRole>  $roles
     */
    private function hasMemberRole(User $user, Project $project, array $roles): bool
    {
        return $project->members()
            ->whereKey($user->id)
            ->wherePivotIn('role', array_map(
                fn (ProjectMemberRole $role): string => $role->value,
                $roles,
            ))
            ->exists();
    }
}
