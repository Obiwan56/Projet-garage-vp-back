<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Obtient le chemin vers lequel l'utilisateur doit être redirigé s'il n'est pas authentifié.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Si la requête attend une réponse JSON, aucune redirection n'est nécessaire
        // Sinon, redirige l'utilisateur vers la route 'login'
        return $request->expectsJson() ? null : route('login');
    }
}
