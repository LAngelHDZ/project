<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestasAlumno extends Model
{
    use HasFactory;
    protected $table = 'respuestas_alumno';
    protected $primaryKey = 'idResAlumno';

    protected $fillable = [
        'idResAlumno',
        'examen_alumno_id',
        'rcorrecta'
    ];
}
