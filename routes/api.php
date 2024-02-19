<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehiculeController;
use App\Http\Controllers\API\CommentaireController;
use App\Http\Controllers\API\EnergieController;

use Illuminate\Support\Facades\Route;

// Routes pour les opérations sur les utilisateurs
Route::prefix('user')->group(function () {
    Route::get('/{id}', [UserController::class, 'show']); // Afficher un utilisateur par son ID
    Route::get('/', [UserController::class, 'all']); // Récupérer tous les utilisateurs
    Route::post('/', [UserController::class, 'store']); // Enregistrer un nouvel utilisateur
    Route::put('/{id}', [UserController::class, 'update']); // Mettre à jour un utilisateur existant
    Route::delete('/{id}', [UserController::class, 'delete']); // Supprimer un utilisateur
});

// Route protégée nécessitant une authentification Sanctum pour les utilisateurs
Route::middleware('auth:sanctum')->get('/user', function (Illuminate\Http\Request $request) {
    return $request->user(); // Renvoie l'utilisateur actuellement authentifié
});

// Routes pour les opérations sur les véhicules
Route::prefix('vehicule')->group(function () {
    Route::get('/{id}', [VehiculeController::class, 'show']); // Afficher un véhicule par son ID
    Route::get('/', [VehiculeController::class, 'all']); // Récupérer tous les véhicules
    Route::post('/', [VehiculeController::class, 'store']); // Enregistrer un nouveau véhicule
    Route::put('/{id}', [VehiculeController::class, 'update']); // Mettre à jour un véhicule existant
    Route::delete('/{id}', [VehiculeController::class, 'delete']); // Supprimer un véhicule
});

// Routes pour les opérations sur les commentaires
Route::prefix('commentaire')->group(function () {
    Route::get('/{id}', [CommentaireController::class, 'show']); // Afficher un commentaire par son ID
    Route::get('/', [CommentaireController::class, 'all']); // Récupérer tous les commentaires
    Route::post('/', [CommentaireController::class, 'store']); // Enregistrer un nouveau commentaire
    Route::put('/{id}', [CommentaireController::class, 'update']); // Mettre à jour un commentaire existant
    Route::delete('/{id}', [CommentaireController::class, 'delete']); // Supprimer un commentaire
});

// Routes pour les opérations sur les énergies
Route::prefix('energie')->group(function () {
    Route::get('/{id}', [EnergieController::class, 'show']); // Afficher une énergie par son ID
    Route::get('/', [EnergieController::class, 'all']); // Récupérer toutes les énergies
    Route::post('/', [EnergieController::class, 'store']); // Enregistrer une nouvelle énergie
    Route::put('/{id}', [EnergieController::class, 'update']); // Mettre à jour une énergie existante
    Route::delete('/{id}', [EnergieController::class, 'delete']); // Supprimer une énergie
});

// Route pour la page de connexion
Route::get('/login', function () {
    // Logique de gestion de la page de connexion ici
})->name('login');

//Cors
Route::middleware(['cors'])->prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
});

