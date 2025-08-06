<?php

use App\Livewire\Pages\Reservate;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

uses(RefreshDatabase::class);

it('allows reservation when under capacity starts before and after', function () {
    config(['booking.table_capacity' => 2]);

    $from = Carbon::now()->addHour();
    $to   = $from->copy()->addHour();

    Reservation::factory()->count(1)->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time'   => $to->copy()->addMinutes(10),
    ]);

    $comp = new Reservate();
    $comp->from_date_time = $from->toDateTimeString();
    $comp->to_date_time   = $to->toDateTimeString();

    expect(fn () => $comp->checkAvailability($from, $to))->not->toThrow(ValidationException::class);
});


it('do not allow reservation when full capacity starts before and after', function () {
    config(['booking.table_capacity' => 2]);

    $from = Carbon::now()->addHour();
    $to   = $from->copy()->addHour();

    Reservation::factory()->count(2)->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time'   => $to->copy()->addMinutes(10),
    ]);

    $comp = new Reservate();
    $comp->from_date_time = $from->toDateTimeString();
    $comp->to_date_time   = $to->toDateTimeString();

    expect(fn () => $comp->checkAvailability($from, $to))->toThrow(ValidationException::class);
});

it('do not allow reservation when full capacity inside', function () {
    config(['booking.table_capacity' => 2]);

    $from = Carbon::now()->addHour();
    $to   = $from->copy()->addHour();

    Reservation::factory()->count(2)->create([
        'start_time' => $from->copy()->addMinutes(10),
        'end_time'   => $to->copy()->subMinutes(10),
    ]);

    $comp = new Reservate();
    $comp->from_date_time = $from->toDateTimeString();
    $comp->to_date_time   = $to->toDateTimeString();

    expect(fn () => $comp->checkAvailability($from, $to))->toThrow(ValidationException::class);
});

it('do not allow reservation when full capacity starts before and ends before', function () {
    config(['booking.table_capacity' => 2]);

    $from = Carbon::now()->addHour();
    $to   = $from->copy()->addHour();

    Reservation::factory()->count(2)->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time'   => $to->copy()->subMinutes(10),
    ]);

    $comp = new Reservate();
    $comp->from_date_time = $from->toDateTimeString();
    $comp->to_date_time   = $to->toDateTimeString();

    expect(fn () => $comp->checkAvailability($from, $to))->toThrow(ValidationException::class);
});

it('do not allow reservation when full capacity starts after and ends after', function () {
    config(['booking.table_capacity' => 2]);

    $from = Carbon::now()->addHour();
    $to   = $from->copy()->addHour();

    Reservation::factory()->count(2)->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time'   => $to->copy()->subMinutes(10),
    ]);

    $comp = new Reservate();
    $comp->from_date_time = $from->toDateTimeString();
    $comp->to_date_time   = $to->toDateTimeString();

    expect(fn () => $comp->checkAvailability($from, $to))->toThrow(ValidationException::class);
});

it('do not allow reservation when one overlap start, second end, and one is inside', function () {
    config(['booking.table_capacity' => 2]);

    $from = Carbon::now()->addHour();
    $to   = $from->copy()->addHour();

    Reservation::factory()->count(1)->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time'   => $from->copy()->addMinutes(15),
    ]);
    Reservation::factory()->count(1)->create([
        'start_time' => $to->copy()->subMinutes(15),
        'end_time'   => $to->copy()->addMinutes(10),
    ]);
    Reservation::factory()->count(1)->create([
        'start_time' => $from->copy()->addMinutes(10),
        'end_time'   => $to->copy()->subMinutes(10),
    ]);

    $comp = new Reservate();
    $comp->from_date_time = $from->toDateTimeString();
    $comp->to_date_time   = $to->toDateTimeString();

    expect(fn () => $comp->checkAvailability($from, $to))->toThrow(ValidationException::class);
});

it('allow reservation when one overlap start', function () {
    config(['booking.table_capacity' => 2]);

    $from = Carbon::now()->addHour();
    $to   = $from->copy()->addHour();

    Reservation::factory()->count(1)->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time'   => $from->copy()->addMinutes(15),
    ]);

    $comp = new Reservate();
    $comp->from_date_time = $from->toDateTimeString();
    $comp->to_date_time   = $to->toDateTimeString();

    expect(fn () => $comp->checkAvailability($from, $to))->not->toThrow(ValidationException::class);
});
