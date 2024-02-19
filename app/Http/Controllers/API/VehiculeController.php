<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    // Récupérer un enregistrement de la table vehicule avec son id
    public function show(int $id) {
        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            return $vehicule;
        } else {
            return response()->json(['message' => 'Véhicule non trouvé.'], 404);
        }
    }

    // Enregistrement d'un véhicule
    public function store(Request $request) {
        $request->validate([
            'marque' => 'required',
            'model' => 'required',
            'prix' => 'required',
            'km' => 'required',
            'description' => 'required',
            'year' => 'required',
            'img' => 'required',
        ]);

        Vehicule::create($request->all());
        return response()->json(['message' => 'Véhicule enregistré avec succès.'], 201);
    }

    // Mise à jour d'un véhicule
    public function update(Request $request, int $id) {
        $request->validate([
            'marque' => 'required',
            'model' => 'required',
            'prix' => 'required',
            'km' => 'required',
            'description' => 'required',
            'year' => 'required',
            'img' => 'required',
        ]);

        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            $vehicule->update($request->all());
            return response()->json(['message' => 'Véhicule mis à jour avec succès.']);
        } else {
            return response()->json(['message' => 'Véhicule non trouvé.'], 404);
        }
    }

    // Récupération de tous les véhicules
    public function all() {
        return Vehicule::all();
    }

    // Suppression d'un véhicule
    public function delete(int $id)  {
        $vehicule = Vehicule::find($id);
        if ($vehicule) {
            $vehicule->delete();
            return response()->json(['message' => 'Véhicule supprimé avec succès.']);
        } else {
            return response()->json(['message' => 'Véhicule non trouvé.'], 404);
        }
    }
}
