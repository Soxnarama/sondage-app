<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SondageController;

// Routes protégées qui nécessitent une authentification
Route::middleware('auth')->group(function () {
    // Routes publiques
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestion des sondages
    Route::prefix('sondages')->name('sondages.')->group(function () {
        Route::get('/', [SondageController::class, 'index'])->name('index');
        Route::get('/create', [SondageController::class, 'create'])->name('create');
        Route::post('/', [SondageController::class, 'store'])->name('store');
        Route::get('/{id_sondage}', [SondageController::class, 'show'])->name('show');
        Route::get('/{id_sondage}/edit', [SondageController::class, 'edit'])->name('edit');
        Route::patch('/{id_sondage}', [SondageController::class, 'update'])->name('update');
        Route::patch('/{id_sondage}/publish', [SondageController::class, 'publish'])->name('publish');
        
        // Gestion des questions
        Route::get('/{id_sondage}/questions/create', [SondageController::class, 'createQuestions'])->name('questions.create');
        Route::post('/{id_sondage}/questions', [SondageController::class, 'addQuestion'])->name('questions.store');
        Route::put('/{id_sondage}/questions/{question}', [SondageController::class, 'updateQuestion'])->name('questions.update');
        Route::delete('/{id_sondage}/questions/{question}', [SondageController::class, 'deleteQuestion'])->name('questions.delete');
        Route::get('/{id_sondage}/questions', [SondageController::class, 'getQuestions'])->name('questions.index');

        // Routes pour les réponses
        Route::get('/{id_sondage}/reponses', [SondageController::class, 'viewReponses'])->name('reponses.index');
        Route::get('/{id_sondage}/reponses/export', [SondageController::class, 'exportReponses'])->name('reponses.export');
    });

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route publique pour répondre au sondage
Route::get('/s/{url}', [SondageController::class, 'repondre'])->name('sondages.repondre');
Route::post('/s/{url}/reponses', [SondageController::class, 'storeReponses'])->name('sondages.reponses.store');
Route::get('/s/{url}/merci', [SondageController::class, 'merci'])->name('sondages.reponse.merci');

require __DIR__.'/auth.php';
