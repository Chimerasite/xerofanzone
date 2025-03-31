<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForagingController;
use App\Http\Controllers\CometController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\FanCreationController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'show'])->name('home');

//Profile
Route::get('/profile', function () {
    return view('profile.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('settings.destroy');
});

// Foraging
Route::get('/statistics/foraging', [ForagingController::class, 'index'])->name('stats.foraging');
Route::get('/statistics/foraging/upload', [ForagingController::class, 'update'])->name('stats.foraging-update');
Route::get('/statistics/foraging/edit', [ForagingController::class, 'edit'])->middleware(['auth', 'ad_mod', 'verified'])->name('stats.foraging-edit');

// Comets
Route::get('/statistics/comet-clusters', [CometController::class, 'index'])->name('stats.comets');
Route::get('/statistics/comet-clusters/upload', [CometController::class, 'update'])->name('stats.comets-update');
Route::get('/statistics/comet-clusters/calculator', [CometController::class, 'math'])->name('stats.comets-math');

//Lost Items
Route::get('/statistics/lost-items', [LostItemController::class, 'index'])->name('stats.lostItems');
Route::get('/statistics/lost-items/upload', [LostItemController::class, 'update'])->name('stats.lostItems-update');
Route::get('/statistics/lost-items/edit', [LostItemController::class, 'edit'])->middleware(['auth', 'ad_mod', 'verified'])->name('stats.lostItems-edit');

// Creations
Route::get('/fan-creations', [FanCreationController::class, 'index'])->name('fancreations');
Route::get('/fan-creations/create', [FanCreationController::class, 'create'])->middleware(['auth', 'verified'])->name('fancreations-create');
Route::get('/fan-creations/{post:slug}', [FanCreationController::class, 'show'])->name('fancreations-show');
Route::get('/fan-creations/{post:slug}/edit', [FanCreationController::class, 'edit'])->middleware(['auth', 'post_owner:{post:slug}', 'verified'])->name('fancreations-edit');

// Footer
Route::get('/terms', function () {
    return view('info.terms');
})->name('terms');
Route::get('/privacy', function () {
    return view('info.privacy');
})->name('privacy');
Route::get('/credits', function () {
    return view('info.credits');
})->name('credits');


//Admin
Route::middleware(['auth', 'ad_mod', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'show'])->name('admin.show');
});


require __DIR__.'/auth.php';
