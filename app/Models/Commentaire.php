<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    /**
     * Les attributs pouvant être massivement assignés.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prenom',       // Prénom de la personne qui commente
        'commentaire',  // Le contenu du commentaire
        'note',         // La note attribuée au commentaire
        'date',         // La date du commentaire
    ];
}
