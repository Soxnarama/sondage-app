<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Le nom de la clé primaire si elle n'est pas 'id'
    protected $primaryKey = 'id_user';

    // Spécifie si la clé primaire est auto-incrémentée
    public $incrementing = true;

    // Type de la clé primaire
    protected $keyType = 'int';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'last_name',
        'first_name',
        'username',
        'mail',
        'password',
        'domaine',
    ];

    // Les attributs à masquer dans les tableaux (ex : quand on fait un return JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Les attributs castés automatiquement
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Par défaut, Laravel utilise 'email', mais ici tu utilises 'mail'
    public function getAuthIdentifierName()
    {
        return 'mail';
    }
}
