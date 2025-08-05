<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Pages\Homepage::class)
    ->name('homepage');

Route::get('/login', \App\Livewire\Pages\Login::class)
    ->name('login');

Route::get('/registration', \App\Livewire\Pages\Registration::class)
    ->name('registration');

Route::get('/reservate', \App\Livewire\Pages\Reservate::class)
    ->name('reservate');
