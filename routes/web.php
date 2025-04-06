<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SondageController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Route pour afficher le formulaire de création d'un sondage
Route::get('/sondages/create', [SondageController::class, 'create'])->name('sondages.create');

// Si tu as une méthode pour enregistrer le sondage, définis une route POST pour traiter le formulaire
Route::post('/sondages', [SondageController::class, 'store'])->name('sondages.store');
