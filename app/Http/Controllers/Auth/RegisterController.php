<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'username' => $request->username,
            'mail' => $request->mail,
            'password' => Hash::make($request->password),
            'domaine' => $request->domaine,
        ]);

        Auth::login($user);

        return redirect()->route('welcome')->with('success', 'Inscription réussie !');
    }
}