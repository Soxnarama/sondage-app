<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            \Log::info('Tentative de connexion avec:', $request->only(['login', 'password']));
            
            $result = $request->authenticate();
            \Log::info('Résultat authentification:', ['success' => Auth::check()]);

            $request->session()->regenerate();

            return redirect()->intended(route('welcome'));
        } catch (\Exception $e) {
            \Log::error('Erreur authentification:', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
