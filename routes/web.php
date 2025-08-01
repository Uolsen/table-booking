<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Pages\Homepage::class)
    ->name('homepage');
