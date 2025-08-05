<?php

use App\Livewire\Pages\Reservate;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Reservate::class)
        ->assertStatus(200);
});
