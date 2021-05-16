<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
    use HasFactory;

    protected $table = 'rubricaActividad';
    protected $primaryKey = 'idRubricaActividad';

    protected $fillable = [
        'idRubricaActividad',
        'criterio',
        'descripcion',
        'puntuacion',
        'actividad_id'
    ];
}
