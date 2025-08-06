<?php

namespace App\Livewire\Pages;

use App\Helpers\ReservationHelper;
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

        $tableNumber = ReservationHelper::checkAvailability($from, $to);

        $reservation = Reservation::create([
            'people_count' => $this->seats,
            'start_time' => $from,
            'end_time' => $to,
            'table_number' => $tableNumber,
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
}
