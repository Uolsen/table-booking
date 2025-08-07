<?php

namespace App\Livewire\Pages;

use App\Helpers\ReservationHelper;
use App\Models\Reservation;
use App\Notifications\TableReservated;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Reservate extends Component
{
    public int $seats = 1;

    public $fromDateTime = null;
    public $toDateTime = null;

    public $availableDates = [];

    public function rules(): array
    {
        return [
            'seats' => 'required|integer|min:1|max:' . config('booking.table_capacity', 10),
            'fromDateTime' => 'required|date|after_or_equal:now',
            'toDateTime' => [
                'required',
                Rule::date()
                    ->afterOrEqual(Carbon::make($this->fromDateTime ?? now())->addMinutes(config('booking.min_reservation_duration', 30))->toDateTimeString())
                    ->beforeOrEqual(Carbon::make($this->fromDateTime ?? now())->addMinutes(config('booking.max_reservation_duration', 120))->toDateTimeString()),
            ]
        ];
    }

    public function submit()
    {
        $this->validate();

        $from = Carbon::make($this->fromDateTime);
        $to = Carbon::make($this->toDateTime);

        $tableNumber = ReservationHelper::checkAvailability($from, $to, 'fromDateTime');

        $reservation = Reservation::create([
            'people_count' => $this->seats,
            'start_time' => $from,
            'end_time' => $to,
            'table_number' => $tableNumber,
        ]);

        $reservation->user()->associate(auth()->user());
        $reservation->save();

        \Notification::send(auth()->user(), new TableReservated($reservation));

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.reservate');
    }
}
