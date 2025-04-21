<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionReponse extends Model
{
    use HasFactory;

    protected $table = 'option_reponses';
    protected $primaryKey = 'id_option';

    protected $fillable = [
        'id_question',
        'intitule_option'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }
}