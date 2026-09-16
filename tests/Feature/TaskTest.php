<?php

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

test('guest cannot view tasks', function () {
    /** @var TestCase $this */
    $this->get('/tasks')->assertRedirect('/login');
});

test('authenticated user can create and complete a task', function () {
    /** @var TestCase $this */
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/tasks', ['title' => 'Deploy the app'])
        ->assertRedirect('/tasks');

    $task = Task::firstOrFail();
    expect($task->user_id)->toBe($user->id)
        ->and($task->title)->toBe('Deploy the app')
        ->and($task->completed)->toBeFalse();

    $this->actingAs($user)
        ->patch("/tasks/{$task->id}", ['completed' => 1])
        ->assertRedirect('/tasks');

    expect($task->fresh()->completed)->toBeTrue();
});

test('user cannot change another users task', function () {
    /** @var TestCase $this */
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $task = $owner->tasks()->create(['title' => 'Private task']);

    $this->actingAs($otherUser)
        ->patch("/tasks/{$task->id}", ['completed' => 1])
        ->assertForbidden();

    expect($task->fresh()->completed)->toBeFalse();
});
