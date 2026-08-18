<?php

use App\Enums\AssignmentRole;
use App\Enums\ProjectMemberRole;
use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;

it('resolves user relationships', function () {
    $user = User::factory()->createOne();
    $project = Project::factory()->createOne(['created_by' => $user->id]);
    $task = Task::factory()->createOne(['created_by' => $user->id]);
    $team = Team::factory()->createOne(['created_by' => $user->id]);
    $file = File::query()->create([
        'original_name' => 'doc.pdf',
        'file_name' => 'doc.pdf',
        'extension' => 'pdf',
        'file_type' => 'document',
        'size' => 1024,
        'created_by' => $user->id,
        'fileable_type' => Project::class,
        'fileable_id' => $project->id,
    ]);

    $project->members()->attach($user->id, ['role' => ProjectMemberRole::Editor->value]);
    $task->assignees()->attach($user->id, ['role' => AssignmentRole::Editor->value]);
    $team->members()->attach($user->id);

    expect($user->createdProjects)->toHaveCount(1)
        ->and($user->createdProjects->first()->is($project))->toBeTrue()
        ->and($user->projects)->toHaveCount(1)
        ->and($user->assignedTasks)->toHaveCount(1)
        ->and($user->teams)->toHaveCount(1)
        ->and($user->createdTeams)->toHaveCount(1)
        ->and($user->createdTasks)->toHaveCount(1)
        ->and($user->createdFiles)->toHaveCount(1)
        ->and($user->createdFiles->first()->is($file))->toBeTrue();
});

it('resolves project relationships', function () {
    $user = User::factory()->createOne();
    $project = Project::factory()->createOne(['created_by' => $user->id]);
    $task = Task::factory()->createOne(['project_id' => $project->id]);
    $team = Team::factory()->createOne();

    $project->members()->attach($user->id, ['role' => ProjectMemberRole::Admin->value]);
    $project->teams()->attach($team->id);
    File::query()->create([
        'original_name' => 'spec.pdf',
        'file_name' => 'spec.pdf',
        'extension' => 'pdf',
        'file_type' => 'document',
        'size' => 2048,
        'fileable_type' => Project::class,
        'fileable_id' => $project->id,
    ]);

    $project->load(['createdBy', 'tasks', 'teams', 'members', 'files']);

    expect($project->createdBy->is($user))->toBeTrue()
        ->and($project->tasks)->toHaveCount(1)
        ->and($project->tasks->first()->is($task))->toBeTrue()
        ->and($project->teams)->toHaveCount(1)
        ->and($project->members)->toHaveCount(1)
        ->and($project->members->first()->pivot->role)->toBe(ProjectMemberRole::Admin)
        ->and($project->files)->toHaveCount(1);
});

it('resolves task self-referential and assignee relationships', function () {
    $parent = Task::factory()->createOne();
    $subtask = Task::factory()->createOne([
        'project_id' => $parent->project_id,
        'parent_task_id' => $parent->id,
    ]);
    $assignee = User::factory()->createOne();

    $parent->assignees()->attach($assignee->id, ['role' => AssignmentRole::Viewer->value]);
    File::query()->create([
        'original_name' => 'task.pdf',
        'file_name' => 'task.pdf',
        'extension' => 'pdf',
        'file_type' => 'document',
        'size' => 256,
        'fileable_type' => Task::class,
        'fileable_id' => $parent->id,
    ]);

    $parent->load(['parent', 'subtasks', 'assignees', 'project', 'files']);

    expect($parent->subtasks)->toHaveCount(1)
        ->and($parent->subtasks->first()->is($subtask))->toBeTrue()
        ->and($subtask->fresh()->parent->is($parent))->toBeTrue()
        ->and($parent->assignees)->toHaveCount(1)
        ->and($parent->assignees->first()->pivot->role)->toBe(AssignmentRole::Viewer)
        ->and($parent->project)->not->toBeNull()
        ->and($parent->files)->toHaveCount(1);
});

it('resolves team relationships', function () {
    $user = User::factory()->createOne();
    $team = Team::factory()->createOne(['created_by' => $user->id]);
    $project = Project::factory()->createOne();

    $team->members()->attach($user->id);
    $team->projects()->attach($project->id);

    $team->load(['createdBy', 'members', 'projects', 'teamMembers']);

    expect($team->createdBy->is($user))->toBeTrue()
        ->and($team->members)->toHaveCount(1)
        ->and($team->projects)->toHaveCount(1)
        ->and($team->teamMembers)->toHaveCount(1);
});

it('resolves file morph and creator relationships', function () {
    $user = User::factory()->createOne();
    $project = Project::factory()->createOne();

    $file = File::query()->create([
        'original_name' => 'report.pdf',
        'file_name' => 'report.pdf',
        'extension' => 'pdf',
        'file_type' => 'document',
        'size' => 512,
        'created_by' => $user->id,
        'fileable_type' => Project::class,
        'fileable_id' => $project->id,
    ]);

    $file->load(['fileable', 'createdBy']);

    expect($file->fileable)->toBeInstanceOf(Project::class)
        ->and($file->fileable->is($project))->toBeTrue()
        ->and($file->createdBy->is($user))->toBeTrue();
});

it('resolves custom pivot back relationships', function () {
    $user = User::factory()->createOne();
    $project = Project::factory()->createOne();
    $task = Task::factory()->createOne(['project_id' => $project->id]);
    $team = Team::factory()->createOne();

    $project->members()->attach($user->id, ['role' => ProjectMemberRole::Editor->value]);
    $project->teams()->attach($team->id);
    $task->assignees()->attach($user->id, ['role' => AssignmentRole::Viewer->value]);

    $projectMember = $project->members()->firstOrFail()->pivot;
    $projectTeam = $project->teams()->firstOrFail()->pivot;
    $assignment = $task->assignees()->firstOrFail()->pivot;

    expect($projectMember->project->is($project))->toBeTrue()
        ->and($projectMember->user->is($user))->toBeTrue()
        ->and($projectTeam->project->is($project))->toBeTrue()
        ->and($projectTeam->team->is($team))->toBeTrue()
        ->and($assignment->task->is($task))->toBeTrue()
        ->and($assignment->user->is($user))->toBeTrue();
});
