<?php

use App\Livewire\Pages\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    Livewire::test(Registration::class)
        ->assertStatus(200);
});

it('has a registration form', function () {
    Livewire::test(Registration::class)
        ->assertSee('Register')
        ->assertSee('Name')
        ->assertSee('Email')
        ->assertSee('Password')
        ->assertSee('Confirm Password');
});

it('registers a new user with valid inputs', function () {
    $userData = [
        'name'                  => 'Test User',
        'email'                 => 'test@example.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
    ];

    Livewire::test(Registration::class)
        ->set('name', $userData['name'])
        ->set('email', $userData['email'])
        ->set('password', $userData['password'])
        ->set('passwordConfirmation', $userData['password_confirmation'])
        ->call('submit')
        ->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('users', [
        'email' => $userData['email'],
    ]);

    $this->assertAuthenticated();
});

it('throws a validation error on mismatched passwords', function () {
    Livewire::test(Registration::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('passwordConfirmation', 'differentpassword')
        ->call('submit')
        ->assertHasErrors(['password']);
});

it('redirect if user is already logged in', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(Registration::class)
        ->assertRedirect(route('homepage'));
});
