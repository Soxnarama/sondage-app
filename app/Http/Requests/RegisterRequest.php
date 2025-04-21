<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'mail' => ['required', 'string', 'email', 'max:255', 'unique:users,mail'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'domaine' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required' => 'Le nom est requis',
            'first_name.required' => 'Le prénom est requis',
            'username.required' => 'Le nom d\'utilisateur est requis',
            'username.unique' => 'Ce nom d\'utilisateur est déjà utilisé',
            'mail.required' => 'L\'adresse email est requise',
            'mail.email' => 'L\'adresse email doit être valide',
            'mail.unique' => 'Cette adresse email est déjà utilisée',
            'password.required' => 'Le mot de passe est requis',
            'password.min' => 'Le mot de passe doit faire au moins 8 caractères',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
        ];
    }
}