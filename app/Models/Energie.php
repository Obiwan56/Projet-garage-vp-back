<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Energie extends Model
{
    // Utilisation du trait HasFactory pour ajouter des fonctionnalités de fabrique
    use HasFactory;

    /**
     * Les attributs pouvant être massivement assignés.
     *
     * @var array<string>
     */
    protected $fillable = [
        'carburant',    // Type de carburant (ex: essence, diesel, électrique, etc.)
        'prix',         // Prix du carburant
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

    /**
     * Relation avec le modèle Vehicule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }
}
