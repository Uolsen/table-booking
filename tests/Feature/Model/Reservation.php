<?php

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can be created via factory', function () {
    $reservation = Reservation::factory()->create();

    expect($reservation)
        ->toBeInstanceOf(Reservation::class)
        ->and($reservation->id)->not->toBeNull();
});

it('casts people_count, start_time and end_time correctly', function () {
    $start = now()->startOfHour();
    $end = $start->copy()->addHours(2);

    $reservation = Reservation::factory()->create([
        'table_number' => 1,
        'people_count' => 5,
        'start_time'   => $start,
        'end_time'     => $end,
    ]);

    expect($reservation->table_number)
        ->toBeInt()
        ->toBe(1);

    expect($reservation->people_count)
        ->toBeInt()
        ->toBe(5);

    expect($reservation->start_time)
        ->toBeInstanceOf(\Illuminate\Support\Carbon::class)
        ->and($reservation->start_time->eq($start))->toBeTrue();

    expect($reservation->end_time)
        ->toBeInstanceOf(\Illuminate\Support\Carbon::class)
        ->and($reservation->end_time->eq($end))->toBeTrue();
});

it('belongs to a user', function () {
    $user = User::factory()->create();
    $reservation = Reservation::factory()->for($user)->create();

    expect($reservation->user)
        ->toBeInstanceOf(User::class)
        ->and($reservation->user->id)
        ->toEqual($user->id);
});
