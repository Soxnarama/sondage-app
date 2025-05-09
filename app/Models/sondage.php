<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    use HasFactory;

    // Spécifie la table associée au modèle
    protected $table = 'sondages';

    // Spécifie la clé primaire associée au modèle
    protected $primaryKey = 'id_sondage';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'id_user',
        'titre_sondage',
        'logo',
        'statut',
        'url',
    ];

    // Définir la relation avec le modèle User
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Définir la relation avec le modèle Question
    public function questions()
    {
        return $this->hasMany(Question::class, 'id_sondage');
    }

    // La méthode pour générer un identifiant unique pour l'URL du sondage (si nécessaire)
    public static function generateUrl($titreSondage)
    {
        return str_slug($titreSondage) . '-' . uniqid();
    }
}
