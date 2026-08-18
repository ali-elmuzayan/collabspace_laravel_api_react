<?php

use App\Enums\ProjectMemberRole;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\QueryException;

it('attaches project members with a role', function () {
    $user = User::factory()->createOne();
    $project = Project::factory()->createOne();

    $project->members()->attach($user->id, ['role' => ProjectMemberRole::Viewer->value]);

    expect($project->members()->first()->pivot->role)->toBe(ProjectMemberRole::Viewer);
});

it('defaults project members to viewer access', function () {
    $user = User::factory()->createOne();
    $project = Project::factory()->createOne();

    $project->members()->attach($user->id);

    expect($project->members()->first()->pivot->role)->toBe(ProjectMemberRole::Viewer);
});

it('prevents duplicate project member assignments', function () {
    $user = User::factory()->createOne();
    $project = Project::factory()->createOne();

    $project->members()->attach($user->id, ['role' => ProjectMemberRole::Editor->value]);

    expect(fn () => $project->members()->attach($user->id, ['role' => ProjectMemberRole::Admin->value]))
        ->toThrow(QueryException::class);
});

it('prevents duplicate task assignee assignments', function () {
    $user = User::factory()->createOne();
    $task = Task::factory()->createOne();

    $task->assignees()->attach($user->id, ['role' => 'editor']);

    expect(fn () => $task->assignees()->attach($user->id, ['role' => 'viewer']))
        ->toThrow(QueryException::class);
});
