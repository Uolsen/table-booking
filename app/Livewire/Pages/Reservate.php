<?php

namespace App\Livewire\Pages;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Reservate extends Component
{
    public int $seats = 1;

    public $from_date_time = null;
    public $to_date_time = null;

    public $available_dates = [];

    public function rules(): array
    {
        return [
            'seats' => 'required|integer|min:1|max:' . config('booking.table_capacity', 10),
            'from_date_time' => 'required|date|after_or_equal:now',
            'to_date_time' => [
                'required',
                Rule::date()
                    ->afterOrEqual(Carbon::make($this->from_date_time ?? now())->addMinutes(config('booking.min_reservation_duration', 30))->toDateTimeString())
                    ->beforeOrEqual(Carbon::make($this->from_date_time ?? now())->addMinutes(config('booking.max_reservation_duration', 120))->toDateTimeString()),
            ]
        ];
    }

    public function submit()
    {
        $this->validate();

        $from = Carbon::make($this->from_date_time);
        $to = Carbon::make($this->to_date_time);
        $this->checkFromAvailability($from);

        $this->checkAvailability($from, $to);

        $reservation = Reservation::create([
            'people_count' => $this->seats,
            'start_time' => $from,
            'end_time' => $to,
        ]);

        $reservation->user()->associate(auth()->user());
        $reservation->save();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.reservate');
    }

    public function setFromDate(Carbon $from)
    {
        $this->from_date_time = $from->toDateTimeString();
    }

    public function setToDate(Carbon $to)
    {
        $this->to_date_time = $to->toDateTimeString();
    }

    public function checkFromAvailability(Carbon $from): void
    {
        $this->validate([
            'from_date_time' => 'required|date|after_or_equal:now',
        ]);

        // check count of reservations for the given DateTime
        $from_reservations_count = Reservation::query()
            ->where('start_time', '<=', $from)
            ->where('end_time', '>=', $from)
            ->count();

        if ($from_reservations_count >= config('booking.table_capacity', 10)) {
            ValidationException::withMessages([
                'from_date_time' => 'The selected date and time is not available.',
            ]);
        }
    }

    public function checkAvailability(Carbon $from, Carbon $to): void
    {
        // basic date validation
        $this->validate([
            'from_date_time' => 'required|date|after_or_equal:now',
            'to_date_time' => 'required|date|after_or_equal:from_date_time',
        ]);

        $capacity = config('booking.table_capacity', 10);

        // grab all overlapping reservations
        $reservations = Reservation::query()
            ->where('start_time', '<=', $to)
            ->where('end_time', '>=', $from)
            ->get(['start_time', 'end_time']);

        // collect the key check‐points: from, to, and every res start/end inside the window
        $times = collect([$from->copy(), $to->copy()]);
        foreach ($reservations as $r) {
            if ($r->start_time->between($from, $to)) {
                $times->push($r->start_time->copy());
            }
            if ($r->end_time->between($from, $to)) {
                $times->push($r->end_time->copy());
            }
        }

        // sort them and at each instant count overlapping reservations
        $times = $times->sort();
        foreach ($times as $instant) {
            $overlapCount = Reservation::query()
                ->where('start_time', '<=', $instant)
                ->where('end_time', '>=', $instant)
                ->count();

            if ($overlapCount >= $capacity) {
                throw ValidationException::withMessages([
                    'from_date_time' => 'Maximum number of reservations reached for the selected period.',
                ]);
            }
        }
    }
}
