<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',  // Assure que l'email est valide
            'password' => 'required|string|min:8', // Assure que le mot de passe est valide
        ]);

        // Essayer de se connecter avec les identifiants
        $credentials = $request->only('mail', 'password');

        if (Auth::attempt($credentials)) {
            // Une fois connecté, on vérifie manuellement l'utilisateur
            $user = Auth::user(); // ou en utilisant la méthode login manuellement
            auth()->login($user);
        
            return redirect()->route('sondages.create'); // Redirection vers la création du sondage
        }

        // Si la connexion échoue, afficher les erreurs
        return back()->withErrors(['mail' => 'Identifiants incorrects']);
    }
}
