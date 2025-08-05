<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Pages\Homepage::class)
    ->name('homepage');

Route::get('/login', \App\Livewire\Pages\Login::class)
    ->name('login');

Route::get('/reservate', \App\Livewire\Pages\Reservate::class)
    ->name('reservate');
