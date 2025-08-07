<?php

namespace Tests\Helpers;

use App\Helpers\ReservationHelper;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

uses(RefreshDatabase::class);

it('allows reservation to table 2 if table 1 is occupied around the start', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    Reservation::factory()->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time' => $from->copy()->addMinutes(10),
        'table_number' => 1,
    ]);

    $availableTable = ReservationHelper::checkAvailability($from, $to, 'fromDateTime');
    expect($availableTable)->toBe(2);
});

it('allows reservation to table 2 if table 1 is occupied around the end', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    Reservation::factory()->create([
        'start_time' => $to->copy()->subMinutes(10),
        'end_time' => $to->copy()->addMinutes(10),
        'table_number' => 1,
    ]);

    $availableTable = ReservationHelper::checkAvailability($from, $to, 'fromDateTime');
    expect($availableTable)->toBe(2);
});

it('allows reservation to table 2 if table 1 is occupied inside', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    Reservation::factory()->create([
        'start_time' => $from->copy()->addMinutes(10),
        'end_time' => $to->copy()->subMinutes(10),
        'table_number' => 1,
    ]);

    $availableTable = ReservationHelper::checkAvailability($from, $to, 'fromDateTime');
    expect($availableTable)->toBe(2);
});

it('allows reservation to table 2 if table 1 is occupied outside', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    Reservation::factory()->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time' => $to->copy()->addMinutes(10),
        'table_number' => 1,
    ]);

    $availableTable = ReservationHelper::checkAvailability($from, $to, 'fromDateTime');
    expect($availableTable)->toBe(2);
});

it('allows reservation to table 2 if table 1 is occupied around and inside', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    Reservation::factory()->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time' => $from->copy()->addMinutes(10),
        'table_number' => 1,
    ]);
    Reservation::factory()->create([
        'start_time' => $from->copy()->addMinutes(15),
        'end_time' => $to->copy()->subMinutes(15),
        'table_number' => 1,
    ]);
    Reservation::factory()->create([
        'start_time' => $to->copy()->subMinutes(10),
        'end_time' => $to->copy()->addMinutes(10),
        'table_number' => 1,
    ]);

    $availableTable = ReservationHelper::checkAvailability($from, $to, 'fromDateTime');
    expect($availableTable)->toBe(2);
});

it('throws error if table 1 and table two is occupied around the start', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    // Reservate table 1
    reservateTable($from, $to);

    // Reservate table 2
    Reservation::factory()->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time' => $from->copy()->addMinutes(10),
        'table_number' => 2,
    ]);

    expect(fn () => ReservationHelper::checkAvailability($from, $to, 'fromDateTime'))->toThrow(ValidationException::class);
});

it('throws error if table 1 and table two is occupied around the end', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    // Reservate table 1
    reservateTable($from, $to);

    // Reservate table 2
    Reservation::factory()->create([
        'start_time' => $to->copy()->subMinutes(10),
        'end_time' => $to->copy()->addMinutes(10),
        'table_number' => 2,
    ]);

    expect(fn () => ReservationHelper::checkAvailability($from, $to, 'fromDateTime'))->toThrow(ValidationException::class);
});

it('throws error if table 1 and table two is occupied inside', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    // Reservate table 1
    reservateTable($from, $to);

    // Reservate table 2
    Reservation::factory()->create([
        'start_time' => $from->copy()->addMinutes(10),
        'end_time' => $to->copy()->subMinutes(10),
        'table_number' => 2,
    ]);

    expect(fn () => ReservationHelper::checkAvailability($from, $to, 'fromDateTime'))->toThrow(ValidationException::class);
});

it('throws error if table 1 and table two is occupied outside', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    // Reservate table 1
    reservateTable($from, $to);

    // Reservate table 2
    Reservation::factory()->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time' => $to->copy()->addMinutes(10),
        'table_number' => 2,
    ]);

    expect(fn () => ReservationHelper::checkAvailability($from, $to, 'fromDateTime'))->toThrow(ValidationException::class);
});

it('throws error if table 1 and table 2 is occupied around and inside', function () {
    config(['booking.table_count' => 2]);

    $from = now()->addHour();
    $to = $from->copy()->addHour();

    // Reservate table 1
    reservateTable($from, $to);

    // Reservate table 2
    reservateTable($from, $to, 2);

    expect(fn () => ReservationHelper::checkAvailability($from, $to, 'fromDateTime'))->toThrow(ValidationException::class);
});



/**
 * @param Carbon $from
 * @param Carbon $to
 * @return void
 */
function reservateTable(Carbon $from, Carbon $to, int $table = 1): void
{
    Reservation::factory()->create([
        'start_time' => $from->copy()->subMinutes(10),
        'end_time' => $from->copy()->addMinutes(10),
        'table_number' => $table,
    ]);
    Reservation::factory()->create([
        'start_time' => $from->copy()->addMinutes(15),
        'end_time' => $to->copy()->subMinutes(15),
        'table_number' => $table,
    ]);
    Reservation::factory()->create([
        'start_time' => $to->copy()->subMinutes(10),
        'end_time' => $to->copy()->addMinutes(10),
        'table_number' => $table,
    ]);
}
