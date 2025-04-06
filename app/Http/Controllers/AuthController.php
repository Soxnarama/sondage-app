<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // Afficher la page de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gérer la soumission du formulaire de connexion
public function login(Request $request)
{
    // Validation des données de l'utilisateur
    $validator = Validator::make($request->all(), [
        'username' => ['required', 'string'],
        'password' => ['required'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Authentifier l'utilisateur avec les informations fournies
    $credentials = $request->only('username', 'password');
    
    // Remplacer l'email par username dans la tentative d'authentification
    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        // Redirige vers la page demandée ou vers /dashboard par défaut
        return redirect()->intended('/dashboard');
    }

    // Si l'authentification échoue, renvoyer un message d'erreur
    return back()->withErrors([
        'username' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
    ]);
}

    

    // Afficher la page d'enregistrement
    public function showRegisterForm()
    {
        return view('auth.register');
    }

   // Gérer la soumission du formulaire d'enregistrement
public function register(Request $request)
{
    // Validation des données de l'utilisateur
    $validator = Validator::make($request->all(), [
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Créer un nouvel utilisateur
    $user = User::create([
        'username' => $request->username,  // Utiliser le champ username
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Authentifier l'utilisateur et rediriger
    Auth::login($user);

    // Rediriger vers la page d'accueil ou tableau de bord
    return redirect()->route('dashboard');
}


    // Gérer la déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        // Rediriger vers la page d'accueil après la déconnexion
        return redirect('/');
    }
}
