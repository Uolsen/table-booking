<?php

use App\Livewire\Pages\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);


it('renders successfully', function () {
    Livewire::test(Login::class)
        ->assertStatus(200);
});

it('has a sign in form', function () {
    Livewire::test(Login::class)
        ->assertSee('Sign in to your account')
        ->assertSee('Email')
        ->assertSee('Password');
});

it('logs in the user with correct credentials', function () {
    // Arrange: Create a user with known credentials.
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    // Act: Attempt to log in using Livewire component.
    Livewire::test(Login::class)
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertRedirect(route('homepage'));

    // Assert: The user should be authenticated.
    $this->assertAuthenticatedAs($user);
});

it('throws a validation error on incorrect credentials', function () {
    // Arrange: Create a user with known credentials.
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    // Act & Assert: Attempt to log in with an incorrect password.
    Livewire::test(Login::class)
        ->set('email', 'test@example.com')
        ->set('password', 'wrongpassword')
        ->call('submit')
        ->assertHasErrors(['email']);
});

