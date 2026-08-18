<?php

use App\Enums\ProjectMemberRole;
use App\Models\Project;
use App\Models\User;
use App\Policies\ProjectPolicy;
use App\Services\ProjectService;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\getJson;

it('forbids non-members from viewing a project', function () {
    /** @var User $user */
    $user = User::factory()->createOne(['role' => 'user']);
    $project = Project::factory()->createOne();

    Sanctum::actingAs($user);

    getJson("/api/v1/projects/{$project->id}")
        ->assertForbidden();
});

it('allows members to view a project', function () {
    /** @var User $user */
    $user = User::factory()->createOne(['role' => 'user']);
    $project = Project::factory()->createOne();
    $project->members()->attach($user->id, ['role' => 'editor']);

    Sanctum::actingAs($user);

    getJson("/api/v1/projects/{$project->id}")
        ->assertOk();
});

it('allows viewers to view but not modify projects', function () {
    $viewer = User::factory()->createOne(['role' => 'user']);
    $project = Project::factory()->createOne();
    $project->members()->attach($viewer->id, ['role' => ProjectMemberRole::Viewer->value]);
    $policy = app(ProjectPolicy::class);

    expect($policy->view($viewer, $project))->toBeTrue()
        ->and($policy->update($viewer, $project))->toBeFalse()
        ->and($policy->delete($viewer, $project))->toBeFalse()
        ->and($policy->assignTeam($viewer, $project))->toBeFalse();
});

it('allows editors to update but not administer projects', function () {
    $editor = User::factory()->createOne(['role' => 'user']);
    $project = Project::factory()->createOne();
    $project->members()->attach($editor->id, ['role' => ProjectMemberRole::Editor->value]);
    $policy = app(ProjectPolicy::class);

    expect($policy->view($editor, $project))->toBeTrue()
        ->and($policy->update($editor, $project))->toBeTrue()
        ->and($policy->delete($editor, $project))->toBeFalse()
        ->and($policy->assignTeam($editor, $project))->toBeFalse();
});

it('allows project administrators to manage projects', function () {
    $projectAdmin = User::factory()->createOne(['role' => 'user']);
    $project = Project::factory()->createOne();
    $project->members()->attach($projectAdmin->id, ['role' => ProjectMemberRole::Admin->value]);
    $policy = app(ProjectPolicy::class);

    expect($policy->update($projectAdmin, $project))->toBeTrue()
        ->and($policy->delete($projectAdmin, $project))->toBeTrue()
        ->and($policy->assignTeam($projectAdmin, $project))->toBeTrue();
});

it('includes project creators in their project listing without membership rows', function () {
    $creator = User::factory()->createOne(['role' => 'user']);
    $project = Project::factory()->createOne(['created_by' => $creator->id]);

    $projects = app(ProjectService::class)->getAllProjects($creator);

    expect($projects)->toHaveCount(1)
        ->and($projects->first()->is($project))->toBeTrue();
});
