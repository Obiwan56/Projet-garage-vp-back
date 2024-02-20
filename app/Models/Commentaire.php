<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    // Utilisation du trait HasFactory pour ajouter des fonctionnalités de fabrique
    use HasFactory;

    /**
     * Les attributs pouvant être massivement assignés.
     *
     * @var array<string>
     */
    protected $fillable = [
        'prenom',       // Prénom de la personne qui commente
        'commentaire',  // Le contenu du commentaire
        'note',         // La note attribuée au commentaire
        'date',         // La date du commentaire
    ];

    /**
     * Les attributs qui ne seront pas inclus dans le tableau de sortie JSON.
     *
     * @var array<string>
     */
    protected $hidden = [];

    /**
     * Les types de données des attributs.
     *
     * @var array<string, string>
     */
    protected $casts = [];
}
