<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenAlumno extends Model
{
    use HasFactory;

    protected $table = 'examen_alumno';
    protected $primaryKey = 'idExamenAlumno';

    protected $fillable = [
        'idExamenAlumno',
        'examen_id',
        'pregunta_id',
        'alumno_ca_id',
        'respuestas',
    ];       
}
