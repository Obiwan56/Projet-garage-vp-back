<?php

namespace App\Models;

// Importation des traits nécessaires
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Utilisation des traits pour ajouter des fonctionnalités au modèle
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs pouvant être massivement assignés.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',     // Nom de l'utilisateur
        'email',    // Adresse email de l'utilisateur
        'password', // Mot de passe de l'utilisateur
    ];

    /**
     * Les attributs qui ne seront pas inclus dans le tableau de sortie JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Mot de passe caché
        'remember_token',   // Jeton de rappel caché
    ];

    /**
     * Les types de données des attributs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',  // Date/heure de vérification de l'email
        'password' => 'hashed',             // Mot de passe hashé
    ];
}
