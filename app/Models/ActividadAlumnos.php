<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadAlumnos extends Model
{
    use HasFactory;

    protected $table = 'actividades_alumnos';
    protected $primaryKey = 'idActividadAlumno';

    protected $fillable = [
        'idActividadAlumno',
        'archivo',
        'fechaEntrega',
        'Hora',
        'actividad_id',
        'alumno_id',
    ];
}
