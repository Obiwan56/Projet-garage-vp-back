<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    // Utilisation du trait HasFactory pour ajouter des fonctionnalités de fabrique
    use HasFactory;

    /**
     * Les attributs pouvant être massivement assignés.
     *
     * @var array<string>
     */
    protected $fillable = [
        'marque',       // Marque du véhicule
        'model',        // Modèle du véhicule
        'prix',         // Prix du véhicule
        'km',           // Kilométrage du véhicule
        'description',  // Description du véhicule
        'year',         // Année de fabrication du véhicule
        'img',          // Image du véhicule
        'energie_id',   // Clé étrangère pour l'énergie du véhicule
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
    protected $casts = [
        'year' => 'date',   // L'attribut 'year' est casté en type 'date'
    ];
}
