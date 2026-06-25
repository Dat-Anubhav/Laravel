<?php

use App\Models\User;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{actingAs, get};

uses(RefreshDatabase::class);

test('guest is redirected to login', function () {
    get('/user')
        ->assertRedirect('/user/login');
});

test('logged in user with no teams is redirected to team registration page', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'type' => 'user',
    ]);

    actingAs($user)
        ->get('/user')
        ->assertRedirect('/user/new');
});

test('logged in user with a team is redirected to their team dashboard', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'type' => 'user',
    ]);

    $team = Team::create([
        'name' => 'My Team',
        'slug' => 'my-team',
    ]);

    $user->teams()->attach($team);

    actingAs($user)
        ->get('/user')
        ->assertRedirect('/user/' . $team->getRouteKey());
});

test('user cannot access a team dashboard they do not belong to', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'type' => 'user',
    ]);

    $team = Team::create([
        'name' => 'Some Other Team',
        'slug' => 'other-team',
    ]);

    // Do NOT attach user to the team

    actingAs($user)
        ->get('/user/' . $team->getRouteKey())
        ->assertStatus(404);
});
