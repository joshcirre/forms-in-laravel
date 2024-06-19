<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'journals' => auth()->user()->journals()->orderBy('created_at', 'desc')->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/journal', function (Request $request) {
    $validated = $request->validate([
        'summary' => 'required|string|min:3',
        'notes' => 'sometimes|nullable|string|min:5',
        'rating' => 'required|numeric|min:0|max:10',
    ]);

    auth()->user()->journals()->create($validated);

    return back();
})->name('journal.store');

require __DIR__.'/auth.php';
