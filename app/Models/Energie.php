<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Energie extends Model
{
    use HasFactory;

    protected $fillable = ['carburant', 'prix']; // Exemple d'attributs massivement affectables

    // Exemple de relation avec un autre modèle
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }
}
