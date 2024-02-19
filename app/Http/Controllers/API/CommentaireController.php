<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    // Récupérer un enregistrement de la table commentaire avec son id
    public function show(int $id) {
        $commentaire = Commentaire::find($id);
        if ($commentaire) {
            return $commentaire;
        } else {
            return response()->json(['message' => 'commentaire non trouvé.'], 404);
        }
    }

    // Enregistrement d'un commentaire
    public function store(Request $request) {
        $request->validate([
            'id' => 'required',
            'prenom' => 'required',
            'commentaire' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);

        Commentaire::create($request->all());
        return response()->json(['message' => 'commentaire enregistré avec succès.'], 201);
    }

    // Mise à jour d'un commentaire
    public function update(Request $request, int $id) {
        $request->validate([
            'id' => 'required',
            'prenom' => 'required',
            'commentaire' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);

        $commentaire = Commentaire::find($id);
        if ($commentaire) {
            $commentaire->update($request->all());
            return response()->json(['message' => 'commentaire mis à jour avec succès.']);
        } else {
            return response()->json(['message' => 'commentaire non trouvé.'], 404);
        }
    }

    // Récupération de tous les commentaires
    public function all() {
        return Commentaire::all();
    }

    // Suppression d'un commentaire
    public function delete(int $id)  {
        $commentaire = Commentaire::find($id);
        if ($commentaire) {
            $commentaire->delete();
            return response()->json(['message' => 'commentaire supprimé avec succès.']);
        } else {
            return response()->json(['message' => 'commentaire non trouvé.'], 404);
        }
    }
}
