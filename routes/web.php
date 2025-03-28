<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SauceController;
use App\Http\Controllers\SauceLikeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('sauces.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/sauces/{sauce}/like', [SauceLikeController::class, 'like'])->name('sauces.like');
    Route::post('/sauces/{sauce}/dislike', [SauceLikeController::class, 'dislike'])->name('sauces.dislike');

    // Toutes les routes des sauces
    Route::get('/sauces', [SauceController::class, 'index'])->name('sauces.index');
    Route::get('/sauces/create', [SauceController::class, 'create'])->name('sauces.create');
    Route::post('/sauces', [SauceController::class, 'store'])->name('sauces.store');
    Route::get('/sauces/{sauce}', [SauceController::class, 'show'])->name('sauces.show');
    Route::get('/sauces/{sauce}/edit', [SauceController::class, 'edit'])->name('sauces.edit');
    Route::put('/sauces/{sauce}', [SauceController::class, 'update'])->name('sauces.update');
    Route::delete('/sauces/{sauce}', [SauceController::class, 'destroy'])->name('sauces.destroy');
});

require __DIR__.'/auth.php';