<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reponse';

    protected $fillable = [
        'id_question',
        'id_user',
        'intitule_reponse'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}