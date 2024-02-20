<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    // Méthode pour obtenir les messages communs
    private function getMessage(string $messageKey): string {
        // Tableau associatif des messages avec des clés
        $messages = [
            'vehiculeNotFound' => 'Véhicule non trouvé.',
            'vehiculeSaved' => 'Véhicule enregistré avec succès.',
            'vehiculeUpdated' => 'Véhicule mis à jour avec succès.',
            'vehiculeDeleted' => 'Véhicule supprimé avec succès.',
        ];
        // Retourne le message correspondant à la clé
        return $messages[$messageKey];
    }

    // Méthode pour afficher un véhicule par son ID
    public function show(int $id) {
        // Recherche du véhicule par son ID
        $vehicule = Vehicule::find($id);
        // Vérification si le véhicule existe
        if ($vehicule) {
            // Retourne le véhicule s'il est trouvé
            return $vehicule;
        } else {
            // Retourne une réponse JSON avec un message d'erreur s'il n'est pas trouvé
            return response()->json(['message' => $this->getMessage('vehiculeNotFound')], 404);
        }
    }

    // Méthode pour enregistrer un nouveau véhicule
    public function store(Request $request) {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'marque' => 'required',
            'model' => 'required',
            'prix' => 'required',
            'km' => 'required',
            'description' => 'required',
            'year' => 'required|date',
            'energie_id' => 'required|exists:energie,id',
        ]);

        // Création d'une nouvelle instance de véhicule et assignation des données validées
        $vehicule = new Vehicule;
        $vehicule->marque = $validatedData['marque'];
        $vehicule->model = $validatedData['model'];
        $vehicule->prix = $validatedData['prix'];
        $vehicule->km = $validatedData['km'];
        $vehicule->description = $validatedData['description'];
        $vehicule->year = $validatedData['year'];
        $vehicule->energie_id = $validatedData['energie_id'];
        $vehicule->save();

        // Retourne une réponse JSON avec un message de succès
        return response()->json(['message' => $this->getMessage('vehiculeSaved')], 201);
    }

    // Méthode pour mettre à jour un véhicule existant
    public function update(Request $request, int $id) {
        // Recherche du véhicule par son ID
        $vehicule = Vehicule::find($id);
        // Vérification si le véhicule existe
        if (!$vehicule) {
            // Retourne une réponse JSON avec un message d'erreur s'il n'est pas trouvé
            return response()->json(['message' => $this->getMessage('vehiculeNotFound')], 404);
        }

        // Validation des données entrantes
        $validatedData = $request->validate([
            'marque' => 'required',
            'model' => 'required',
            'prix' => 'required',
            'km' => 'required',
            'description' => 'required',
            'year' => 'required|date',
            'energie_id' => 'required|exists:energie,id',
        ]);

        // Assignation des données validées au véhicule
        $vehicule->marque = $validatedData['marque'];
        $vehicule->model = $validatedData['model'];
        $vehicule->prix = $validatedData['prix'];
        $vehicule->km = $validatedData['km'];
        $vehicule->description = $validatedData['description'];
        $vehicule->year = $validatedData['year'];
        $vehicule->energie_id = $validatedData['energie_id'];
        $vehicule->save();

        // Retourne une réponse JSON avec un message de succès
        return response()->json(['message' => $this->getMessage('vehiculeUpdated')]);
    }

    // Méthode pour récupérer tous les véhicules
    public function all() {
        // Récupération de tous les véhicules dans la base de données
        return Vehicule::all();
    }

    // Méthode pour supprimer un véhicule
    public function delete(int $id) {
        // Recherche du véhicule par son ID
        $vehicule = Vehicule::find($id);
        // Vérification si le véhicule existe
        if ($vehicule) {
            // Suppression du véhicule de la base de données
            $vehicule->delete();
            // Retourne une réponse JSON avec un message de succès
            return response()->json(['message' => $this->getMessage('vehiculeDeleted')]);
        } else {
            // Retourne une réponse JSON avec un message d'erreur s'il n'est pas trouvé
            return response()->json(['message' => $this->getMessage('vehiculeNotFound')], 404);
        }
    }
}
