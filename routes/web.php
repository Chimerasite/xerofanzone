<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForagingController;
use App\Http\Controllers\CometController;
use App\Http\Controllers\FanCreationController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

//Profile
Route::get('/profile', function () {
    return view('profile.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('settings.destroy');
});

// Foraging
Route::get('/statistics/foraging', [ForagingController::class, 'Index'])->name('stats.foraging');
Route::get('/statistics/foraging/upload', [ForagingController::class, 'Update'])->name('stats.foraging-update');
Route::get('/statistics/foraging/edit', [ForagingController::class, 'Edit'])->middleware(['auth', 'ad_mod'])->name('stats.foraging-edit');

// Comets
Route::get('/statistics/cometclusters', [CometController::class, 'Index'])->name('stats.comets');
Route::get('/statistics/cometclusters/upload', [CometController::class, 'Update'])->name('stats.comets-update');
Route::get('/statistics/cometclusters/calculator', [CometController::class, 'Math'])->name('stats.comets-math');

// Creations
Route::get('/fan-creations', [FanCreationController::class, 'Index'])->name('fancreations');
Route::get('/fan-creations/create', [FanCreationController::class, 'Create'])->middleware(['auth'])->name('fancreations-create');
Route::get('/fan-creations/{post:slug}', [FanCreationController::class, 'Show'])->name('fancreations-show');
Route::get('/fan-creations/{post:slug}/edit', [FanCreationController::class, 'Edit'])->middleware(['auth', 'post_owner:{post:slug}'])->name('fancreations-edit');

//Admin
Route::middleware(['auth', 'ad_mod'])->group(function () {
    Route::get('/admin', [AdminController::class, 'show'])->name('admin.show');
});


require __DIR__.'/auth.php';
