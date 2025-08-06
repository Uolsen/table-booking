<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Dashboard extends Component
{
    public $reservations = [];

    public function mount()
    {
        $this->reservations = auth()->user()->reservations()
            ->orderBy('start_time', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
