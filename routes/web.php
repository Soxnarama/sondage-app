<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SondageController;



Route::get('/', function () {
    return view('welcome');
});
// Route pour afficher le formulaire de connexion
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route pour traiter la connexion
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
//pour la creation de sondage
Route::middleware('auth')->group(function () {
    // Route pour afficher la liste des sondages
    Route::get('/sondages', [SondageController::class, 'index'])->name('sondages.index');

    // Route pour afficher le formulaire de création de sondage
    Route::get('/sondages/create', [SondageController::class, 'create'])->name('sondages.create');

    // Route pour soumettre la création du sondage
    Route::post('/sondages', [SondageController::class, 'store'])->name('sondages.store');
});
