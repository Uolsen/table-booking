<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Pages\Homepage::class)
    ->name('homepage');

Route::get('/login', \App\Livewire\Pages\Login::class)
    ->name('login');

Route::get('/registration', \App\Livewire\Pages\Registration::class)
    ->name('registration');

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('homepage');
})->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/reservate', \App\Livewire\Pages\Reservate::class)
        ->name('reservate');

    Route::get('/dashboard', \App\Livewire\Pages\Dashboard::class)
        ->name('dashboard')
        ->middleware('auth');
});
