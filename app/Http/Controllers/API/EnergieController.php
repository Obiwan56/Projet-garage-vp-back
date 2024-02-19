<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Energie;
use Illuminate\Http\Request;

class EnergieController extends Controller
{
    // Récupérer un enregistrement de la table energie avec son id
    public function show(int $id) {
        $energie = Energie::find($id);
        if ($energie) {
            return $energie;
        } else {
            return response()->json(['message' => 'energie non trouvé.'], 404);
        }
    }

    // Enregistrement d'un energie
    public function store(Request $request) {
        $request->validate([
            'id' => 'required',
            'carburant' => 'required',
        ]);

        Energie::create($request->all());
        return response()->json(['message' => 'energie enregistré avec succès.'], 201);
    }

    // Mise à jour d'un energie
    public function update(Request $request, int $id) {
        $request->validate([
            'id' => 'required',
            'carburant' => 'required',
        ]);

        $energie = Energie::find($id);
        if ($energie) {
            $energie->update($request->all());
            return response()->json(['message' => 'energie mis à jour avec succès.']);
        } else {
            return response()->json(['message' => 'energie non trouvé.'], 404);
        }
    }

    // Récupération de tous les energies
    public function all() {
        return Energie::all();
    }

    // Suppression d'un energie
    public function delete(int $id)  {
        $energie = Energie::find($id);
        if ($energie) {
            $energie->delete();
            return response()->json(['message' => 'energie supprimé avec succès.']);
        } else {
            return response()->json(['message' => 'energie non trouvé.'], 404);
        }
    }
}
