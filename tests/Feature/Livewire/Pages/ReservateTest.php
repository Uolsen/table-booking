<?php

use App\Livewire\Pages\Reservate;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\TableReservated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(Reservate::class)
        ->assertStatus(200);
});

it('creates reservation', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Notification::fake();

    Livewire::test(Reservate::class)
        ->set('seats', 2)
        ->set('fromDateTime', now()->addHours(1))
        ->set('toDateTime', now()->addHours(3))
        ->call('submit')
        ->assertRedirect(route('dashboard'));

    expect(Reservation::count())->toBe(1);

    Notification::assertSentTo(
        [$user], TableReservated::class
    );
});

it('shows error if dates are not selected', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(Reservate::class)
        ->set('seats', 2)
        ->call('submit')
        ->assertHasErrors(['fromDateTime', 'toDateTime']);
});

it('shows error if no empty tables', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    config(['booking.table_count' => 2]);

    Reservation::factory()->create([
        'start_time' => now()->addHour(),
        'end_time' => now()->addHours(2),
        'table_number' => 1,
        'people_count' => 2,
        'user_id' => $user->id,
    ]);
    Reservation::factory()->create([
        'start_time' => now()->addHour(),
        'end_time' => now()->addHours(2),
        'table_number' => 2,
        'people_count' => 2,
        'user_id' => $user->id,
    ]);

    Notification::fake();

    Livewire::test(Reservate::class)
        ->set('seats', 2)
        ->set('fromDateTime', now()->addHour())
        ->set('toDateTime', now()->addHours(2))
        ->call('submit')
        ->assertHasErrors(['fromDateTime']);

    // Assert notification sent
    Notification::assertNothingSent();
});
