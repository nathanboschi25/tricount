<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/groups', [GroupController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('groups.index');

Route::get('/groups/create', [GroupController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('groups.create');

Route::post('/groups', [GroupController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('groups.store');

Route::get('/groups/{group}', [GroupController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('groups.edit');

Route::put('/groups/{group}', [GroupController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('groups.update');

Route::delete('/groups/{group}', [GroupController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('groups.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
