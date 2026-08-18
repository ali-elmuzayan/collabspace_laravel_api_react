<?php

use App\Enums\ProjectMemberRole;
use App\Events\ProjectCreated;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

it('allows global administrators to create projects', function () {
    Event::fake([ProjectCreated::class]);
    $admin = User::factory()->createOne(['role' => 'admin']);
    Sanctum::actingAs($admin);

    postJson('/api/v1/projects', [
        'name' => 'Platform API',
        'description' => 'Internal platform API',
        'slug' => 'platform-api',
        'type' => 'api',
        'start_date' => '2026-08-14',
        'end_date' => '2026-09-14',
        'deadline' => '2026-09-20',
        'duration' => 31,
        'status' => 'pending',
        'priority' => 'high',
    ])->assertOk()
        ->assertJsonPath('data.name', 'Platform API')
        ->assertJsonPath('data.members.0.role', ProjectMemberRole::Admin->value);

    assertDatabaseHas('projects', [
        'slug' => 'platform-api',
        'created_by' => $admin->id,
    ]);
    assertDatabaseHas('project_members', [
        'user_id' => $admin->id,
        'role' => ProjectMemberRole::Admin->value,
    ]);
    Event::assertDispatched(ProjectCreated::class);
});

it('allows editors to update projects and forbids viewers', function () {
    $editor = User::factory()->createOne(['role' => 'user']);
    $viewer = User::factory()->createOne(['role' => 'user']);
    $project = Project::factory()->createOne();
    $project->members()->attach($editor->id, ['role' => ProjectMemberRole::Editor->value]);
    $project->members()->attach($viewer->id, ['role' => ProjectMemberRole::Viewer->value]);

    Sanctum::actingAs($viewer);
    patchJson("/api/v1/projects/{$project->id}", ['name' => 'Viewer edit'])
        ->assertForbidden();

    Sanctum::actingAs($editor);
    patchJson("/api/v1/projects/{$project->id}", ['name' => 'Editor edit'])
        ->assertOk()
        ->assertJsonPath('data.name', 'Editor edit');

    assertDatabaseHas('projects', [
        'id' => $project->id,
        'name' => 'Editor edit',
    ]);
});

it('returns structured teams instead of invalid pluck values', function () {
    $admin = User::factory()->createOne(['role' => 'admin']);
    $project = Project::factory()->createOne();
    $team = Team::factory()->createOne(['name' => 'Backend']);
    $project->teams()->attach($team->id);
    Sanctum::actingAs($admin);

    getJson('/api/v1/projects')
        ->assertOk()
        ->assertJsonPath('data.0.teams.0.id', $team->id)
        ->assertJsonPath('data.0.teams.0.name', 'Backend');
});
