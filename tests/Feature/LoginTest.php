<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can login with valid credentials', function () {
    User::factory()->create([
        'email' => 'ali@example.com',
        'password' => bcrypt('password'),
    ]);
    $response = $this->postJson('/api/v1/auth/login', [
        'email' => 'ali@example.com',
        'password' => 'password',
    ]);
    $response
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonPath('message', 'Login successfuly')
        ->assertJsonStructure([
            'data' => ['user', 'token'],
        ]);
});
