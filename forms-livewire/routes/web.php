<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', function () {
    return view('dashboard', [
        'journals' => auth()->user()->journals()->orderBy('created_at', 'desc')->get(),
    ]);
})->middleware('auth')->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
