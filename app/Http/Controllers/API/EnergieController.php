<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Energie;
use Illuminate\Http\Request;

class EnergieController extends Controller
{
    // Méthode pour obtenir les messages communs
    private function getMessage(string $messageKey): string {
        // Tableau associatif des messages avec des clés
        $messages = [
            'energieNotFound' => 'Energie non trouvée.',
            'energieSaved' => 'Energie enregistrée avec succès.',
            'energieUpdated' => 'Energie mise à jour avec succès.',
            'energieDeleted' => 'Energie supprimée avec succès.',
        ];
        // Retourne le message correspondant à la clé
        return $messages[$messageKey];
    }

    // Méthode pour afficher une énergie par son ID
    public function show(int $id) {
        // Recherche de l'énergie par son ID
        $energie = Energie::find($id);
        // Vérification si l'énergie existe
        if ($energie) {
            // Retourne l'énergie si elle est trouvée
            return $energie;
        } else {
            // Retourne une réponse JSON avec un message d'erreur si elle n'est pas trouvée
            return response()->json(['message' => $this->getMessage('energieNotFound')], 404);
        }
    }

    // Méthode pour enregistrer une nouvelle énergie
    public function store(Request $request) {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'id' => 'required|unique:energies',
            'carburant' => 'required',
        ]);

        // Création d'une nouvelle instance d'énergie et assignation des données validées
        $energie = new Energie;
        $energie->id = $validatedData['id'];
        $energie->carburant = $validatedData['carburant'];
        $energie->save();

        // Retourne une réponse JSON avec un message de succès
        return response()->json(['message' => $this->getMessage('energieSaved')], 201);
    }

    // Méthode pour mettre à jour une énergie existante
    public function update(Request $request, int $id) {
        // Recherche de l'énergie par son ID
        $energie = Energie::find($id);
        // Vérification si l'énergie existe
        if (!$energie) {
            // Retourne une réponse JSON avec un message d'erreur si elle n'est pas trouvée
            return response()->json(['message' => $this->getMessage('energieNotFound')], 404);
        }

        // Validation des données entrantes
        $validatedData = $request->validate([
            'id' => 'sometimes|required|unique:energies,id,'.$id,
            'carburant' => 'required',
        ]);

        // Assignation des données validées à l'énergie
        $energie->id = $validatedData['id'];
        $energie->carburant = $validatedData['carburant'];
        $energie->save();

        // Retourne une réponse JSON avec un message de succès
        return response()->json(['message' => $this->getMessage('energieUpdated')]);
    }

    // Méthode pour récupérer toutes les énergies
    public function all() {
        // Récupération de toutes les énergies dans la base de données
        return Energie::all();
    }

    // Méthode pour supprimer une énergie
    public function delete(int $id) {
        // Recherche de l'énergie par son ID
        $energie = Energie::find($id);
        // Vérification si l'énergie existe
        if ($energie) {
            // Suppression de l'énergie de la base de données
            $energie->delete();
            // Retourne une réponse JSON avec un message de succès
            return response()->json(['message' => $this->getMessage('energieDeleted')]);
        } else {
            // Retourne une réponse JSON avec un message d'erreur si elle n'est pas trouvée
            return response()->json(['message' => $this->getMessage('energieNotFound')], 404);
        }
    }
}
