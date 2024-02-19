<?php

namespace App\Models; // Définition de l'espace de noms pour le modèle

use Illuminate\Database\Eloquent\Model; // Importation de la classe de base des modèles Eloquent

class Vehicule extends Model // Déclaration de la classe du modèle, qui étend la classe Model d'Eloquent
{
    protected $fillable = ['marque', 'model', 'prix', 'km', 'description', 'year', 'img'];
    /*
    Définition des attributs remplissables massivement pour le modèle.
    Cela indique quels attributs peuvent être massivement attribués lors de
    l'utilisation des méthodes create() ou update().
    */
}
