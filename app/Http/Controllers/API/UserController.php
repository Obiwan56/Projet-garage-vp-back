<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Méthode pour obtenir les messages communs
    private function getMessage(string $messageKey): string {
        // Tableau associatif des messages avec des clés
        $messages = [
            'userNotFound' => 'Utilisateur non trouvé.',
            'userSaved' => 'Utilisateur enregistré avec succès.',
            'userUpdated' => 'Utilisateur mis à jour avec succès.',
            'userDeleted' => 'Utilisateur supprimé avec succès.',
        ];
        // Retourne le message correspondant à la clé
        return $messages[$messageKey];
    }

    // Méthode pour afficher un utilisateur par son ID
    public function show(int $id) {
        // Recherche de l'utilisateur par son ID
        $user = User::find($id);
        // Vérification si l'utilisateur existe
        if ($user) {
            // Retourne l'utilisateur s'il est trouvé
            return $user;
        } else {
            // Retourne une réponse JSON avec un message d'erreur s'il n'est pas trouvé
            return response()->json(['message' => $this->getMessage('userNotFound')], 404);
        }
    }

    // Méthode pour enregistrer un nouvel utilisateur
    public function store(Request $request) {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'nom' => 'required',
            'password' => 'required',
            'prenom' => 'required',
            'role' => 'required',
        ]);

        // Création d'une nouvelle instance d'utilisateur et assignation des données validées
        $user = new User;
        $user->email = $validatedData['email'];
        $user->nom = $validatedData['nom'];
        $user->password = $validatedData['password'];
        $user->prenom = $validatedData['prenom'];
        $user->role = $validatedData['role'];
        $user->save();

        // Retourne une réponse JSON avec un message de succès
        return response()->json(['message' => $this->getMessage('userSaved')], 201);
    }

    // Méthode pour mettre à jour un utilisateur existant
    public function update(Request $request, int $id) {
        // Recherche de l'utilisateur par son ID
        $user = User::find($id);
        // Vérification si l'utilisateur existe
        if (!$user) {
            // Retourne une réponse JSON avec un message d'erreur s'il n'est pas trouvé
            return response()->json(['message' => $this->getMessage('userNotFound')], 404);
        }

        // Validation des données entrantes
        $validatedData = $request->validate([
            'email' => 'sometimes|required|unique:users,email,'.$id,
            'nom' => 'required',
            'password' => 'required',
            'prenom' => 'required',
            'role' => 'required',
        ]);

        // Assignation des données validées à l'utilisateur
        $user->email = $validatedData['email'];
        $user->nom = $validatedData['nom'];
        $user->password = $validatedData['password'];
        $user->prenom = $validatedData['prenom'];
        $user->role = $validatedData['role'];
        $user->save();

        // Retourne une réponse JSON avec un message de succès
        return response()->json(['message' => $this->getMessage('userUpdated')]);
    }

    // Méthode pour récupérer tous les utilisateurs
    public function all() {
        // Récupération de tous les utilisateurs dans la base de données
        return User::all();
    }

    // Méthode pour supprimer un utilisateur
    public function delete(int $id) {
        // Recherche de l'utilisateur par son ID
        $user = User::find($id);
        // Vérification si l'utilisateur existe
        if ($user) {
            // Suppression de l'utilisateur de la base de données
            $user->delete();
            // Retourne une réponse JSON avec un message de succès
            return response()->json(['message' => $this->getMessage('userDeleted')]);
        } else {
            // Retourne une réponse JSON avec un message d'erreur s'il n'est pas trouvé
            return response()->json(['message' => $this->getMessage('userNotFound')], 404);
        }
    }
}
