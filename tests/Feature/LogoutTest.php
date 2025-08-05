<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('logs out an authenticated user', function () {
    // Create a user and authenticate
    $user = User::factory()->create();
    actingAs($user);

    // Perform logout (POST request)
    $response = get(route('logout'));

    // Assert that the response redirects to the login page
    $response->assertRedirect(route('homepage'));

    // Ensure that no user is authenticated
    $this->assertGuest();
});
