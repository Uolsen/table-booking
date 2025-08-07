<?php

use App\Livewire\Pages\Dashboard;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(Dashboard::class)
        ->assertStatus(200);
});

it('loads user reservations on mount', function () {
    $user = User::factory()->create();
    $reservation = Reservation::factory()->for($user)->create();

    $this->actingAs($user);

    Livewire::test(Dashboard::class)
        ->assertSet('reservations.0.id', $reservation->id)
        ->assertSet('reservations.0.user_id', $user->id);
});
