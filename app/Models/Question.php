<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_question';

    protected $fillable = [
        'id_sondage',
        'intitule_question',
        'obligatoire',
        'typeQuestion',
        'description',
        'id_ques_predefinie'
    ];

    protected $casts = [
        'obligatoire' => 'boolean'
    ];

    public function sondage()
    {
        return $this->belongsTo(Sondage::class, 'id_sondage');
    }

    public function optionReponses()
    {
        return $this->hasMany(OptionReponse::class, 'id_question');
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class, 'id_question');
    }
}