<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
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

    return redirect()->route('dashboard')->with('status', 'journal-added');
})->name('journal.store');

require __DIR__.'/auth.php';
