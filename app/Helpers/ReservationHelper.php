<?php

namespace App\Helpers;

use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Validation\ValidationException;

class ReservationHelper
{
    /**
     * Check availability of tables for requested time range.
     *
     * @param Carbon $from
     * @param Carbon $to
     * @return int
     * @throws ValidationException
     */
    public static function checkAvailability(CarbonInterface $from, CarbonInterface $to, string $errorKey): int
    {
        $capacity = config('booking.table_count', 10);

        for ($table = 1; $table <= $capacity; $table++) {
            $reservationExists = Reservation::query()
                ->where('table_number', $table)
                ->where(function ($query) use ($from, $to) {
                    $query->whereBetween('start_time', [$from, $to])
                        ->orWhereBetween('end_time', [$from, $to])
                        ->orWhere(function ($query) use ($from, $to) {
                            $query->where('start_time', '<=', $from)
                                ->where('end_time', '>=', $to);
                        });
                })->exists();

            if (!$reservationExists) {
                return $table; // Return the first available table number
            }
        }

        throw ValidationException::withMessages([
            $errorKey => 'The selected date and time is not available.',
        ]);
    }
}
