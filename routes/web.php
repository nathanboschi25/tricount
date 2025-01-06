<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/groups', [GroupController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('groups.index');

Route::get('/groups/create', [GroupController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('groups.create');

Route::post('/groups', [GroupController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('groups.store');

Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('groups.edit');

Route::put('/groups/{group}', [GroupController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('groups.update');

Route::delete('/groups/{group}', [GroupController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('groups.destroy');

Route::get('/groups/{group}', [GroupController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('groups.show');

Route::get('/groups/{group}/members', [GroupController::class, 'showMembers'])
    ->middleware(['auth', 'verified'])->name('groups.members');

Route::post('/groups/{group}/members', [GroupController::class, 'setMembers'])
    ->middleware(['auth', 'verified'])->name('groups.members-set');

Route::get('/groups/{group}/expenses/create', [ExpenseController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('expenses.create');

Route::post('/groups/{group}/expenses', [ExpenseController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('expenses.store');

// pay somebody in the group (param group and groupuser(receiver)
Route::get('/groups/{group}/payments/{groupUser}/pay', [PaymentController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('payments.create');

Route::post('/groups/{group}/payments/{groupUser}', [PaymentController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('payments.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
