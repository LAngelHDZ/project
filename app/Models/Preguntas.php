<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    use HasFactory;

    protected $table = 'preguntas_examen';
    protected $primaryKey = 'idPregunta';

    protected $fillable = [
        'idPregunta',
        'pregunta',
        'tipo',
        'puntos',
        'examen_id'
    ];
}
